<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Filler;

use Fakerino\Core\Entity\EntityInfo;
use Fakerino\Core\FakeDataFactory;

/**
 * Class EntityFiller,
 * provides functionalities for the entity filler feature.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class EntityFiller implements FillerInterface
{
    private $entity;
    private $faker;

    /**
     * @param mixed           $entity
     * @param FakeDataFactory $faker
     */
    public function __construct($entity, FakeDataFactory $faker)
    {
        $this->entity = $entity;
        $this->faker = $faker;
    }

    /**
     * @return bool
     */
    public function fill()
    {
        $this->fillProperties();
        $this->fillMethods();

        return true;
    }

    /**
     * Fills properties.
     */
    public function fillProperties()
    {
        $entity = $this->entity;
        $entityInfo = new EntityInfo($entity);
        $entityProperties = $entityInfo->getProperties();
        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $fakeData = $this->faker->fake($propertyName)->toArray();
            if ($property->isStatic()) {
                $entity::$$propertyName = $fakeData[0];
            } else {
                $entity->$propertyName = $fakeData[0];
            }
        }
    }

    /**
     * Fills mehtods.
     */
    public function fillMethods()
    {
        $entity = $this->entity;
        $entityInfo = new EntityInfo($entity);
        $entityMethods = $entityInfo->getSetters();
        foreach ($entityMethods as $methods) {
            $methodsName = $methods->getName();
            $nameToFake = substr($methodsName, 3, strlen($methodsName));
            $fakeData = $this->faker->fake($nameToFake)->toArray();
            if ($methods->isStatic()) {
                $entity::$methodsName($fakeData[0]);
            } else {
                $entity->$methodsName($fakeData[0]);
            }
        }
    }
}