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

use Fakerino\Configuration\FakerinoConfigurationInterface;
use Fakerino\Core\Entity\EntityInfo;

/**
 * Class FakeDataFactory,
 * generates fake data
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeDataFactory
{
    /**
     * @var FakerinoConfigurationInterface
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
     * @param FakerinoConfigurationInterface $conf
     */
    public function __construct(FakerinoConfigurationInterface $conf)
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
     * Fills the given entity with fake data.
     *
     * @param object $entity
     */
    public function fillEntity($entity)
    {
        $this->fillProperties($entity);
        $this->fillMethods($entity);
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

    private function fillProperties($entity)
    {
        $entityInfo = new EntityInfo($entity);
        $entityProperties = $entityInfo->getProperties();
        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $fakeData = $this->fake($propertyName)->toArray();
            if ($property->isStatic()) {
                $entity::$$propertyName = $fakeData[0];
            } else {
                $entity->$propertyName = $fakeData[0];
            }
        }
    }

    private function fillMethods($entity)
    {
        $entityInfo = new EntityInfo($entity);
        $entityMethods = $entityInfo->getSetters();
        foreach ($entityMethods as $methods) {
            $methodsName = $methods->getName();
            $nameToFake = substr($methodsName, 3, strlen($methodsName));
            $fakeData = $this->fake($nameToFake)->toArray();
            if ($methods->isStatic()) {
                $entity::$methodsName($fakeData[0]);
            } else {
                $entity->$methodsName($fakeData[0]);
            }
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

    /**
     * Generates the fake output.
     * Iterates, through the generators defined in the FakeData class,
     * until one generator will produce an output.
     *
     * @param string $fakeDataClass
     * @param array  $options
     *
     * @return bool
     */
    private function generateOutput($fakeDataClass, $options = null)
    {
        $fakeData = new $fakeDataClass($options);
        $generators = $fakeData->generatedBy();
        foreach ($generators as $generatorClass) {
            if (class_exists($generatorClass)) {
                $generator = new $generatorClass($fakeData, $this->conf);
                $generatedOutput = $generator->generate();
                if ($generatedOutput === null) {

                    continue;
                } else {
                    $this->out[] = $generatedOutput;

                return true;
                }
            }
        }
    }
}
