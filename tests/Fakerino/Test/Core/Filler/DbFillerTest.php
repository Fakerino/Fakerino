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
    public function setUp()
    {
        $this->num = 3;
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
    public function testFillNumeric($columnName, $columnType)
    {
        $this->mockDoctrineLayer->method('getTotalColumns')->willReturn(1);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnName')->willReturn($columnName);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnType')->willReturn($columnType);

        $rows = $this->dbFiller->fill();
        $this->assertInternalType('array', $rows);
        $this->assertEquals($this->num, count($rows));
    }

    public function provider()
    {
        return array(
            array('integer', 'integer'),
            array('date', 'date'),
            array('datetime', 'datetime'),
            array('time', 'time'),
        );
    }

    public static function tearDownAfterClass()
    {
        DoctrineLayer::$conn = null;
    }
}