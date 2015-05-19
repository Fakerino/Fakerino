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

use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\Database\DoctrineLayer;
use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\FakeHandler;
use Fakerino\Core\Template\TwigTemplate;
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
        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\FileFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\ConfFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());
        $this->fakeGenerator = new FakeDataFactory($fakeHandler, new DoctrineLayer(), new TwigTemplate());
    }

    public function testFakeMethod()
    {
       $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake(array('Name')));
    }

    public function testFakeCallWithUnknowElement()
    {
        $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake('Test'));
    }

    public function testFakeCallWithEmptyElement()
    {
        $this->setExpectedException('Fakerino\FakeData\Exception\MissingRequiredOptionException');
        $this->fakeGenerator->fake();
    }

    public function testFillEntiyWithEmptyElement()
    {
        $this->setExpectedException('Fakerino\FakeData\Exception\MissingRequiredOptionException');
        $this->fakeGenerator->fakeEntity();
    }

    public function testFillTableWithEmptyElement()
    {
        $this->setExpectedException('Fakerino\FakeData\Exception\MissingRequiredOptionException');
        $this->fakeGenerator->fakeTable();
    }

    public function testFakeCallWithConfElement()
    {
        $this->assertInstanceOf('Fakerino\\Core\\FakeDataFactory', $this->fakeGenerator->fake('fake1'));
    }

    public function testFakeToArray()
    {
        $fakeArray = $this->fakeGenerator->fake('fake1')->toArray();
        $this->assertInternalType('array', $fakeArray);

        $this->assertEquals(1, count($fakeArray));
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
        $this->fakeGenerator->fakeEntity($testEntity);

        $this->assertNotNull($testEntity->getOne());
        $this->assertNotNull($testEntity->getFour());
    }

    public function testFakeTemplateFile()
    {
        $templateFile = __DIR__ . '/../Fixtures/template.html';
        $res = $this->fakeGenerator->fakeTemplate($templateFile);

        $this->assertNotContains('{{ surname }}', $res);
    }

    public function testFakeTemplateString()
    {
        $res = $this->fakeGenerator->fakeTemplate('Hello {{ surname }}');

        $this->assertNotContains('{{ surname }}', $res);
    }
}