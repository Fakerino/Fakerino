<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\Database;

use Doctrine\DBAL\Types\Type;
use Fakerino\Core\Database\DbFieldEntity;
use Fakerino\Core\Database\DbRowEntity;
use Fakerino\Core\Database\DoctrineLayer;

class DoctrineLayerTest extends \PHPUnit_Framework_TestCase
{
    public static function tearDownAfterClass()
    {
        DoctrineLayer::$conn = null;
    }

    public function setUp()
    {
        $this->testTable = 'testTable';
        $this->connectionParams = array(
            'user' => null,
            'password' => null,
            'memory' => true,
            'driver' => 'pdo_sqlite'
        );
        $this->dLayer = new DoctrineLayer($this->connectionParams);
        $sql = "CREATE TABLE `" . $this->testTable . "` (
                `numberPk`	INTEGER,
                `number`	INTEGER,
                `text`	TEXT,
                `surname`	TEXT,
                `description`	BLOB,
                PRIMARY KEY(numberPk)
                )";
        $this->dLayer->connect();
        DoctrineLayer::$conn->query($sql);
        $this->dLayer->setTable($this->testTable);
    }

    public function testGetTotalColumns()
    {
        $this->assertEquals(5, $this->dLayer->getTotalColumns());
    }

    public function testGetColumnType()
    {
        $this->assertEquals('integer', $this->dLayer->getColumnType(1));
        $this->assertEquals('string', $this->dLayer->getColumnType(4));
    }

    public function testGetColumnName()
    {
        $this->assertEquals('number', $this->dLayer->getColumnName(1));
    }

    /**
     * @dataProvider provider
     */
    public function testGetFakeType($dType, $fakeType)
    {
        $this->assertEquals($fakeType, $this->dLayer->getFakeType($dType));
    }

    /**
     * @dataProvider provider
     */
    public function testInsert()
    {
        $filed = new DbFieldEntity('number', 1, 'integer');
        $row = new DbRowEntity();
        $row->setFields($filed);

        $this->assertTrue($this->dLayer->insert($row));
    }

    public function testWrongTable()
    {
        $this->setExpectedException('Doctrine\DBAL\ConnectionException');

        $this->dLayer->setTable('foo');
    }

    public function provider()
    {
        return array(
            array(Type::BIGINT , 'integer'),
            array(Type::BOOLEAN , 'boolean'),
            array(Type::DATETIME , 'datetime'),
            array(Type::DATETIMETZ , 'datetimetz'),
            array(Type::DATE , 'date'),
            array(Type::TIME , 'time'),
            array(Type::DECIMAL , 'integer'),
            array(Type::INTEGER , 'integer'),
            array(Type::SMALLINT , 'integer'),
            array(Type::STRING , 'string'),
            array(Type::TEXT , 'string'),
            array(Type::BLOB , 'string'),
            array(Type::FLOAT , 'integer'),
            array(Type::GUID , 'integer')
        );
    }
}