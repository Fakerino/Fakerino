<?php

namespace Fakerino\Test\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationFile\IniConfigurationFile;
use Fakerino\DataSource\File\File;

class IniConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testIniToArray()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $iniFilePath = $fileDir . 'file.ini';
        $iniFile = new File($iniFilePath);
        $iniConf = new IniConfigurationFile();
        $iniConf->loadConfiguration($iniFile);
        $iniArray = parse_ini_file($iniFilePath);

        $this->assertEquals($iniArray, $iniConf->toArray());
    }
}
