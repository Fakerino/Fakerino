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
 * Interface DbInterface,
 * provides a database abstraction layer.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface DbInterface
{
    /**
     * Makes a database connection.
     *
     * @param array $connectionParams
     */
    public function connect($connectionParams);

    /**
     * Inserts row in $tableName.
     *
     * @param DbRowEntity   $row
     *
     * @return bool
     */
    public function insert(DbRowEntity $row);

    /**
     * Sets the connection with the $tableName.
     *
     * @param string $tableName
     */
    public function setTable($tableName);

    /**
     * Gets the number of column in the table.
     *
     * @return int
     */
    public function getTotalColumns();

    /**
     * Returns the type of the $num column.
     *
     * @param int $num
     *
     * @return string
     */
    public function getColumnType($num);

    /**
     * Returns the name of the $num column.
     *
     * @param int $num
     *
     * @return string mixed
     */
    public function getColumnName($num);

    /**
     * Returns true if the column is autoincrement.
     *
     * @param int $num
     *
     * @return bool
     */
    public function isColumnAutoincrement($num);

    /**
     * Gets the Fakerino columnType.
     *
     * @param string $columnType
     *
     * @return string
     */
    public function getFakeType($columnType);
}