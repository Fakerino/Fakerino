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
    /**
     * @param mixed           $entity
     * @param FakeDataFactory $faker
     *
     * @return bool
     */
    public function fill($entity, FakeDataFactory $faker)
    {
        $this->fillProperties($entity, $faker);
        $this->fillMethods($entity, $faker);

        return true;
    }

    /**
     * Fills properties.
     *
     * @param mixed           $entity
     * @param FakeDataFactory $faker
     */
    public function fillProperties($entity, FakeDataFactory $faker)
    {
        $entityInfo = new EntityInfo($entity);
        $entityProperties = $entityInfo->getProperties();
        foreach ($entityProperties as $property) {
            $propertyName = $property->getName();
            $fakeData = $faker->fake($propertyName)->toArray();
            if ($property->isStatic()) {
                $entity::$$propertyName = $fakeData[0];
            } else {
                $entity->$propertyName = $fakeData[0];
            }
        }
    }

    /**
     * Fills mehtods.
     *
     * @param mixed           $entity
     * @param FakeDataFactory $faker
     */
    public function fillMethods($entity, FakeDataFactory $faker)
    {
        $entityInfo = new EntityInfo($entity);
        $entityMethods = $entityInfo->getSetters();
        foreach ($entityMethods as $methods) {
            $methodsName = $methods->getName();
            $nameToFake = substr($methodsName, 3, strlen($methodsName));
            $fakeData = $faker->fake($nameToFake)->toArray();
            if ($methods->isStatic()) {
                $entity::$methodsName($fakeData[0]);
            } else {
                $entity->$methodsName($fakeData[0]);
            }
        }
    }
}