<?php

namespace Fakerino\Test;

use Fakerino\Fakerino;
use Fakerino\Helper\FileLocator;

class FakerinoTest extends \PHPUnit_Framework_TestCase
{
    private $testFile;

    public function setUp()
    {
        $fileDir = __DIR__ . '/Fixtures/';
        $this->testFile = $fileDir . 'file.ini';
    }

    public function testDefaultConfigurationSetUp()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create($this->testFile));
    }

    public function testConfigurationNotProvided()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create());
    }

}
