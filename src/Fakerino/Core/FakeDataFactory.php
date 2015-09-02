<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core;

use Fakerino\Core\Database\DbInterface;
use Fakerino\Core\FakeHandler\HandlerInterface;
use Fakerino\Core\Filler\DbFiller;
use Fakerino\Core\Filler\EntityFiller;
use Fakerino\Core\Template\TemplateInterface;
use Fakerino\FakeData\Exception\MissingRequiredOptionException;

/**
 * Class FakeDataFactory,
 * generates fake data
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeDataFactory
{
    /** @var array */
    private $out;

    /** @var string */
    private $outString;

    /** @var string|array */
    private $startElement;

    /** @var \Fakerino\Core\FakeHandler\HandlerInterface  */
    private $fakeHandler;

    /** @var \Fakerino\Core\Database\DbInterface  */
    private $db;

    /** @var \Fakerino\Core\Template\TemplateInterface  */
    private $template;

    /** @var  int */
    private $num = 1;

    /**
     * It receives:
     * the handlers priority for the fake request,
     * the DbInterface for the fakeTable operation,
     * and the TemplateInterface for the fakeTemplate operation.
     *
     * @param HandlerInterface  $fakeHandler
     * @param DbInterface       $db
     * @param TemplateInterface $template
     */
    public function __construct(
        HandlerInterface $fakeHandler,
        DbInterface $db,
        TemplateInterface $template
    )
    {
        $this->fakeHandler = $fakeHandler;
        $this->db = $db;
        $this->template = $template;
    }

    /**
     * Setups the fake element and initializes the output.
     *
     * @param string|array|null $elementName
     *
     * @return FakeDataFactory $this
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fake($elementName = null)
    {
        if ($elementName === null) {
            throw new MissingRequiredOptionException('element to fake');
        }
        $this->startElement = $elementName;
        $this->out = array();
        $this->outString = null;

        return $this;
    }

    /**
     * Fills the given entity with fake data.
     *
     * @param object|null $entity
     *
     * @return bool
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fakeEntity($entity = null)
    {
        if ($entity === null) {
            throw new MissingRequiredOptionException('entity to fake');
        }
        $entityFiller = new EntityFiller($entity, $this);

        return $entityFiller->fill();
    }

    /**
     * Fills the given table with fake data.
     *
     * @param string|null $tableName
     *
     * @return array $rows
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fakeTable($tableName = null)
    {
        if (null === $tableName) {
            throw new MissingRequiredOptionException('table name');
        }
        $dbFiller = new DbFiller($this->db, $tableName, $this, $this->num);
        $rows = $dbFiller->fill();

        return $rows;
    }

    /**
     * Fakes a template file.
     *
     * @param string $file
     *
     * @return string
     */
    public function fakeTemplate($file)
    {
        $this->template->loadTemplate($file);
        $varsName = $this->template->getVariables();
        $out = '';
        $num = $this->num;
        for ($i = 0; $i < $num; $i++) {
            $fakeData = $this->num(1)->fake($varsName)->toArray();
            $data = array_combine(array_values($varsName), $fakeData);
            $out .= $this->template->render($data);
        }

        return $out;
    }

    /**
     * Sets $num for iterate the fake process.
     *
     * @param int $num
     *
     * @return FakeDataFactory $this
     * @throws \Exception
     */
    public function num($num = 1)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * @param int|null $seed
     *
     * @return FakeDataFactory $this
     */
    public function seed($seed = null)
    {
        if ($seed !== null) {
            mt_srand($seed);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->startFake($this->startElement, $this->num);

        return $this->out;
    }

    /**
     * @return string json
     */
    public function toJson()
    {
        $this->startFake($this->startElement, $this->num);

        return json_encode($this->out);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $this->startFake($this->startElement, $this->num);
        array_walk_recursive($this->out, array($this, 'arrayToString'));
        $this->outString = substr($this->outString, 0, -1);

        return $this->outString;
    }

    private function startFake($elementName, $num)
    {
        $out = array();
        $elementToFake = $this->getElementToFake($elementName);
        for ($i = 0; $i < $num; $i++) {
            foreach ($elementToFake as $key => $val) {
                $element = new FakeElement($key, $val);
                $out[] = $this->fakeHandler->handle($element);
            }
        }
        $this->out = $out;
    }

    private function getElementToFake($elementsName)
    {
        if (!is_array($elementsName)) {

            return array($elementsName);
        }

        return $elementsName;
    }

    private function arrayToString($arr)
    {
        $this->outString .= $arr . PHP_EOL;
    }
}