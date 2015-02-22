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


use Fakerino\Configuration\ConfigurationInterface;

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
    private $conf;

    /**
     * @var array
     */
    private $out;

    /**
     * @var string
     */
    private $outString;

    /**
     * @var string
     */
    private $startElement;

    /**
     * Constructor
     *
     * @param ConfigurationInterface $conf
     */
    public function __construct(ConfigurationInterface $conf)
    {
        $this->conf = $conf;
    }

    /**
     * Setups the first element and initializes the output,
     * then starts to fake.
     *
     * @param mixed $elementName
     *
     * @return $this
     */
    public function fake($elementName)
    {
        $this->startElement = $elementName;
        $this->out = array();

        return $this->startFake($elementName);
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
        $out[] = $this->out;
        if (!is_null($this->startElement)) {
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

    private function startFake($elementName)
    {
        $elementToFake = $this->setElementToFake($elementName);
        foreach ($elementToFake as $key => $val) {
            $element = $this->findElementFrom($key, $val);
            if ($this->isAFakeClass($element)) {
                $this->fakeThis($element, $val);
            } else {
                $fakeTag = $this->conf->get('fakerinoTag');
                $elementInConf = $this->conf->get($fakeTag);
                if (array_key_exists($element, $elementInConf)) {
                    $this->fake($elementInConf[$element]);
                } else {
                    $this->fakeThis($element);
                }
            }
        }

        return $this;
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

    private function fakeThis($element, $options = null)
    {
        $this->generateFakeData($element, $options);
    }

    private function isAfakeClass($element)
    {
        $className = $this->getDataClass($element);
        if (class_exists($className)) {

            return true;
        }

        return false;
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
        array_walk_recursive($this->out, array($this,'arrayToString'));

        return $this->outString;
    }

    private function arrayToString($arr)
    {
        $this->outString .= $arr . PHP_EOL;
    }

    private function generateFakeData($element, $options = null)
    {
        $fakeDataClass = $this->getDataClass($element);
        if (!class_exists($fakeDataClass)) {
            $fakeDataClass = $this->getDataClass('GenericString');
        }
        $this->generateOutput($fakeDataClass, $options);
    }

    private function getDataClass($className)
    {
        return 'Fakerino\\FakeData\\Data\\' . $className;
    }

    private function generateOutput($fakeDataClass, $options = null)
    {
        $fakeData = new $fakeDataClass($options);
        $generators = array_reverse($fakeData->generatedBy());
        foreach ($generators as $generatorClass) {
            if (class_exists($generatorClass)) {
                $generator = new $generatorClass($fakeData);
                $generator->setConf($this->conf);
                if (is_null($generatedOut = $generator->generate())) {

                    continue;
                } else {
                    $this->out[] = $generatedOut;

                return true;
                }
            }
        }
    }
}
