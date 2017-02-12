<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Entity;

/**
 * Class EntityInfo,
 * returns information about properties and methods of the provided Entity.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class EntityInfo
{
    const EXCLUDE_STATIC = true;

    /**
     * @var \ReflectionClass
     */
    private $reflectionEntity;

    /**
     * Constructor
     *
     * @param object $entity
     *
     * @throws \RuntimeException
     */
    public function __construct($entity)
    {
        if (!is_object($entity)) {
            throw new \RuntimeException('The value provided is not a Class');
        }
        $this->reflectionEntity = new \ReflectionClass(get_class($entity));
    }

    /**
     * Gets the properties of the object provided.
     *
     * @param int $filter
     *
     * @return array
     */
    public function getProperties($filter = \ReflectionProperty::IS_PUBLIC)
    {
        $properties = array();
        $reflectionProperties = $this->reflectionEntity->getProperties($filter);
        foreach ($reflectionProperties as $property) {
            $properties[] = new Property($property->name, $property->isStatic());
        }

        return $properties;
    }

    /**
     * Returns the public setters methods.
     *
     * @param int $filter
     *
     * @return array
     */
    public function getSetters($filter = \ReflectionProperty::IS_PUBLIC)
    {
        $setters = array();
        $methods = $this->getMethods($filter);
        foreach ($methods as $method) {
            if (substr($method->getName(), 0, 3) === 'set') {
                $setters[] = $method;
            }
        }

        return $setters;
    }

    /**
     * Gets the methods of the object provided.
     *
     * @param int $filter
     *
     * @return array
     */
    public function getMethods($filter = \ReflectionProperty::IS_PUBLIC)
    {
        $methods = array();
        $reflectionMethods = $this->reflectionEntity->getMethods($filter);
        foreach ($reflectionMethods as $method) {
            $methods[] = new Method($method->name, $method->isStatic());
        }

        return $methods;
    }
}