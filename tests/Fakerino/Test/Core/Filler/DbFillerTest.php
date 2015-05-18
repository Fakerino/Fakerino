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
        $faker = new FakeDataFactory($fakeHandler, new DoctrineLayer());
        $this->mockDoctrineLayer = $this->getMockBuilder('Fakerino\Core\Database\DoctrineLayer')
            ->getMock();
        $this->dbFiller = new DbFiller($this->connectionParams, $this->mockDoctrineLayer, $this->testTable, $faker, $this->num);
    }

    public function testFill()
    {
        $this->mockDoctrineLayer->method('getTotalColumns')->willReturn(1);
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnName')->willReturn('integer');
        $this->mockDoctrineLayer->expects($this->exactly($this->num))->method('getColumnType')->willReturn('integer');

        $rows = $this->dbFiller->fill();
        $this->assertInternalType('array', $rows);
        $this->assertEquals($this->num, count($rows));
    }

    public static function tearDownAfterClass()
    {
        DoctrineLayer::$conn = null;
    }
}