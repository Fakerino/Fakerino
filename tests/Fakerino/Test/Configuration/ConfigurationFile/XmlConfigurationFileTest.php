<?php

namespace Fakerino\Test\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationFile\XmlConfigurationFile;
use Fakerino\DataSource\File\File;

class XmlConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testIniToArray()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $xmlFilePath = $fileDir . 'file.xml';
        $xmlFile = new File($xmlFilePath);
        $xmlConf = new XmlConfigurationFile();
        $xmlConf->loadConfiguration($xmlFile);
        $xmlArray = simplexml_load_file($xmlFilePath);

        $this->assertEquals($xmlArray, $xmlConf->toArray());
    }
}
