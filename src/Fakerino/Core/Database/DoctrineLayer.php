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

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\Types\Type;

/**
 * Class DoctrineLayer,
 * provides an interface for the Doctrine DBAL.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class DoctrineLayer implements DbInterface
{
    /* @var \Doctrine\DBAL\DriverManager */
    public static $conn;

    private $tableName;
    private $columns;
    private $totalFields;
    private $databaseConfig;

    /**
     * @param array|null $databaseConfig
     */
    public function __construct($databaseConfig)
    {
        $this->databaseConfig = $databaseConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function connect()
    {
        $config = new \Doctrine\DBAL\Configuration();
        self::$conn = \Doctrine\DBAL\DriverManager::getConnection($this->databaseConfig, $config);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function setTable($tableName)
    {
        $this->tableName = $tableName;
        $schemaManager = self::$conn->getSchemaManager();
        $tableSchema = $schemaManager->listTableColumns($tableName);
        foreach ($tableSchema as $column) {
            $this->columns[] = $column;
        }
        $this->totalFields = count($this->columns);
        if (empty($tableSchema)) {
            throw new ConnectionException(sprintf('Error in database connection, please check the configuration parameter and the table name "%s"', $tableName));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalColumns()
    {
        return $this->totalFields;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnType($num)
    {
        $doctrineType = $this->columns[$num]->getType();

        return $this->getFakeType($doctrineType);
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnName($num)
    {
        return $this->columns[$num]->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnLength($num)
    {
        return $this->columns[$num]->getLength();
    }

    /**
     * {@inheritdoc}
     */
    public function isColumnAutoincrement($num)
    {
        return $this->columns[$num]->getAutoincrement();
    }

    /**
     * {@inheritdoc}
     */
    public function insert(DbRowEntity $rows)
    {
        $queryBuilder = self::$conn->createQueryBuilder();
        $sql = $queryBuilder->insert($this->tableName);
        $values = array();
        $types = array();
        $rowsElement = $rows->getFields();
        foreach ($rowsElement as $field) {
            $sql->setValue($field->getName(), '?');
            $values[] =  $field->getValue();
            $types[] = $field->getType();
        }
        self::$conn->executeQuery($sql, $values, $types);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getFakeType($columnType)
    {
        $fakeType = array(
            Type::BIGINT => 'integer',
            Type::BOOLEAN => 'boolean',
            Type::DATETIME => 'datetime',
            Type::DATETIMETZ => 'datetimetz',
            Type::DATE => 'date',
            Type::TIME => 'time',
            Type::DECIMAL => 'integer',
            Type::INTEGER => 'integer',
            Type::SMALLINT => 'integer',
            Type::STRING => 'string',
            Type::TEXT => 'string',
            Type::BLOB => 'string',
            Type::FLOAT => 'integer',
            Type::GUID => 'integer'
        );

        return $fakeType[strtolower($columnType)];
    }
}