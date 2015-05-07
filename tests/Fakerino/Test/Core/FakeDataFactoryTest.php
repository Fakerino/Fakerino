<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core;

use Fakerino\Core\FakeDataFactory;
use Fakerino\FakeData\Data\StringGenerator;
use Fakerino\Configuration\FakerinoConf;
use Fakerino\Test\Fixtures\TestEntity;

class FakeDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->conf['fake'] = array(
            'fake1' => array(
                'Name' => array('length' => 3),
                'Surname' => null
            ),
            'fake2' => array(
                'Name' => array('length' => 30),
                'Surname' => null
            )
        );
        FakerinoConf::loadConfiguration($this->conf);
        $this->fakeGenerator = new FakeDataFactory();
    }

    public function testFakeMethod()
    {
       $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake(array('Name')));
    }

    public function testFakeCallWithUnknowElement()
    {
        $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake('Test'));
    }

    public function testFakeCallWithConfElement()
    {
        $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake('fake1'));
    }

    public function testFakeToArray()
    {
        $fakeArray = $this->fakeGenerator->fake('fake1')->toArray();
        $this->assertInternalType('array', $fakeArray);

        $this->assertEquals(count($this->conf['fake']['fake1']), count($fakeArray));
    }

    public function testMultipleFakesToArray()
    {
        $num = 3;
        $fakeArray = $this->fakeGenerator->fake('fake1')->num($num)->toArray();

        $this->assertEquals($num, count($fakeArray));
    }

    public function testFakeToJson()
    {
        $fakeJson = $this->fakeGenerator->fake('fake1')->toJson();

        $this->assertThat($fakeJson, $this->isJson());
    }

    public function testMultipleFakesToJson()
    {
        $num = 3;
        $fakeJson = $this->fakeGenerator->fake('fake1')->num($num)->toJson();

        $this->assertEquals($num, count(json_decode($fakeJson)));
    }

    public function testFakeToString()
    {
        $fakeString = (string) $this->fakeGenerator->fake('fake1');

        $this->assertInternalType('string', $fakeString);
    }

    public function testMultipleFakesToString()
    {
        $num = 3;
        $fakeString = (string) $this->fakeGenerator->fake('fake1')->num($num);
        $lineExpected = count($this->conf['fake']['fake1']) * $num;

        $this->assertEquals($lineExpected, substr_count($fakeString, "\n"));
    }

    public function testEntityFiller()
    {
        $testEntity = new TestEntity();
        $this->fakeGenerator->fillEntity($testEntity);

        $this->assertNotNull($testEntity->getOne());
        $this->assertNotNull($testEntity->getFour());
    }

}