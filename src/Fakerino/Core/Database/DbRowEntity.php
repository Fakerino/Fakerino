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
 * Class DbRowEntity,
 * describes a single database row.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class DbRowEntity
{
    /** @var  array */
    private $fields;

    /**
     * @param DbFieldEntity $field
     */
    public function setFields(DbFieldEntity $field)
    {
        $this->fields[] = $field;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $row = array();
        foreach ($this->fields as $field) {
            $row[$field->getName()] = $field->getValue();
        }

        return $row;
    }
}