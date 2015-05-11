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

use Fakerino\Core\Filler\EntityFiller;
use Fakerino\Core\FakeHandler\HandlerInterface;

/**
 * Class FakeDataFactory,
 * generates fake data
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeDataFactory
{
    /**
     * @var array
     */
    private $out;

    /**
     * @var string
     */
    private $outString;

    /**
     * @var FakeHandler
     */
    private $fakeHandler;

    /**
     * @var string|array
     */
    private $startElement;

    /**
     * It receives the handlers priority for the fake request.
     *
     * @param HandlerInterface $fakeHandler
     */
    public function __construct(HandlerInterface $fakeHandler)
    {
        $this->fakeHandler = $fakeHandler;
    }

    /**
     * Setups the first element and initializes the output,
     * then starts to fake.
     *
     * @param string|array $elementName
     *
     * @return $this
     */
    public function fake($elementName)
    {
        $this->startElement = $elementName;
        $this->out = array();
        $this->outString = null;

        return $this->startFake($elementName);
    }

    /**
     * Fills the given entity with fake data.
     *
     * @param object $entity
     *
     * @return bool
     */
    public function fillEntity($entity)
    {
        $entityFiller = new EntityFiller();

        return $entityFiller->fill($entity, $this);
    }

    /**
     * Iterates the fake process $num times
     *
     * @param integer $num
     *
     * @return $this
     * @throws \Exception
     */
    public function num($num)
    {
        $out = array();
        $out[] = $this->out;
        if ($this->startElement !== null) {
            for ($i = 1; $i < $num; $i++) {
                $this->fake($this->startElement);
                $out[] = $this->out;
            }
            $this->out = $out;

            return $this;
        } else {

            throw new \Exception('Please call first the fake method');
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->out;
    }

    /**
     * @return string json
     */
    public function toJson()
    {
        return json_encode($this->out);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        array_walk_recursive($this->out, array($this, 'arrayToString'));

        return $this->outString;
    }

    private function startFake($elementName)
    {
        $out = array();
        $elementToFake = $this->setElementToFake($elementName);
        foreach ($elementToFake as $key => $val) {
            $element = $this->findElementFrom($key, $val);
            $out[] = $this->fakeHandler->handle($element);
        }
        $this->out = $this->flat($out);

        return $this;
    }

    private function flat($array)
    {
        $flatArr = array();
        $recursiveArrayIterator = new \RecursiveArrayIterator($array);
        $iterator = new \RecursiveIteratorIterator($recursiveArrayIterator);
        foreach ($iterator as $value) {
            $flatArr[] = $value;
        }

        return $flatArr;
    }

    private function setElementToFake($elementsName)
    {
        if (!is_array($elementsName)) {

            return array($elementsName);
        }

        return $elementsName;
    }

    private function findElementFrom($key, $val)
    {
        if (is_numeric($key)) {

            return $val;
        }

        return $key;
    }

    private function arrayToString($arr)
    {
        $this->outString .= $arr . PHP_EOL;
    }
}