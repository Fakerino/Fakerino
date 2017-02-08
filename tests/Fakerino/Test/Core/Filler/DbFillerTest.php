<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Test\Filler;

use Fakerino\Core\Database\DoctrineLayer;
use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\FakeHandler;
use Fakerino\Core\Filler\DbFiller;
use Fakerino\Core\Template\TwigTemplate;

class DbFillerTest extends \PHPUnit_Framework_TestCase
{
    private function configure($numberOfFakeData)
    {
        $this->num = $numberOfFakeData;
        $this->testTable = 'testTable';
        $this->connectionParams = array(
            'user' => null,
            'password' => null,
            'memory' => true,
            'driver' => 'pdo_sqlite'
        );
        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());
        $this->mockDoctrineLayer = $this->getMockBuilder('Fakerino\Core\Database\DbInterface')
            ->setConstructorArgs(array($this->connectionParams))
            ->getMock();
        $faker = new FakeDataFactory($fakeHandler, $this->mockDoctrineLayer, new TwigTemplate());

        $this->dbFiller = new DbFiller($this->mockDoctrineLayer, $this->testTable, $faker, $this->num);
    }

    /**
     * @dataProvider provider
     */
    public function testFillNumeric($columnName, $columnType, $columnLength)
    {
        $numberOfFakeData = 3;
        $this->configure($numberOfFakeData);

        $this->mockDoctrineLayer->method('getTotalColumns')->willReturn(1);
        $this->mockDoctrineLayer->expects($this->exactly($numberOfFakeData))->method('getColumnName')->willReturn($columnName);
        $this->mockDoctrineLayer->expects($this->exactly($numberOfFakeData))->method('getColumnType')->willReturn($columnType);
        $this->mockDoctrineLayer->expects($this->exactly($numberOfFakeData))->method('getColumnLength')->willReturn($columnLength);

        $rows = $this->dbFiller->fill();

        $this->assertInternalType('array', $rows);
        $this->assertEquals($this->num, count($rows));
    }

    /**
     * @dataProvider nullLengthValue
     */
    public function testValueWithNullColumnLength($columnName, $columnType, $columnLength, $expectedLength)
    {
        $numberOfFakeData = 1;
        $this->configure($numberOfFakeData);

        $this->mockDoctrineLayer->method('getTotalColumns')->willReturn(1);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnName')->willReturn($columnName);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnType')->willReturn($columnType);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnLength')->willReturn($columnLength);

        $rows = $this->dbFiller->fill();
        $this->assertEquals(strlen($rows[0][$columnName]), $expectedLength);
    }

    public function nullLengthValue()
    {
        return array(
            array('date', 'date', null, 10),
            array('datetime', 'datetime', null, 19),
            array('time', 'time', null, 8),
            array('something', 'something', null, 0),
        );
    }

    public function provider()
    {
        return array(
            array('integer', 'integer', 3),
            array('date', 'date', 10),
            array('datetime', 'datetime', 12),
            array('time', 'time', 10),
        );
    }

    public static function tearDownAfterClass()
    {
        DoctrineLayer::$conn = null;
    }
}