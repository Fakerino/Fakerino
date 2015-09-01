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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}