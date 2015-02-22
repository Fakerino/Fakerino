<?php

namespace Fakerino\Test\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationFile\PhpConfigurationFile;
use Fakerino\DataSource\File\File;

class PhpConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testIniToArray()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $phpFilePath = $fileDir . 'file.php';
        $phpFile = new File($phpFilePath);
        $phpConf = new PhpConfigurationFile();
        $phpConf->loadConfiguration($phpFile);
        include ($phpFilePath);

        $this->assertEquals($conf, $phpConf->toArray());
    }
}
