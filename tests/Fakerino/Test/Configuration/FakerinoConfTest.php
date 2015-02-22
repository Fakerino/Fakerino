<?php

namespace Fakerino\Test\Configuration;

use Fakerino\Configuration\FakerinoConf;

class FkrConfTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->default = array(
            'supportedConfExts' => array('xml', 'php', 'ini'),
            'locale' => 'en_GB',
            'fakerinoTag' => 'fake',
            'fakeFilePath' => 'path'
        );
    }

    public function testMinimumDefaultValues()
    {
        $defaultConfiguration = new FakerinoConf();
        $defaultConfiguration->loadConfiguration();
        $this->assertEquals(array_keys($this->default), array_keys($defaultConfiguration->toArray()));

    }

    public function testAdditionalConfValues()
    {
        $defaultConfiguration = new FakerinoConf();
        $testAdditional = array('test' => 1);
        $this->default = array_merge($testAdditional, $this->default);
        $defaultConfiguration->loadConfiguration($testAdditional);

        $this->assertEquals(array_keys($this->default), array_keys($defaultConfiguration->toArray()));
    }
}

