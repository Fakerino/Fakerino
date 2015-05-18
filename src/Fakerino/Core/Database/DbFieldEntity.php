<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Database;

/**
 * Class DbFieldEntity,
 * describes a single database field.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class DbFieldEntity
{
    /** @var  string */
    private $name;

    /** @var  mixed */
    private $value;

    /** @var  mixed */
    private $type;

    /**
     * @param string $name
     * @param string $value
     * @param mixed  $type
     */
    public function __construct($name, $value, $type)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}