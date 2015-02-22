<?php

namespace Fakerino\Test\Configuration\ConfigurationFile\Helper;

use Fakerino\Configuration\ConfigurationFile\Helper\FileConfigurationLoaderFactory;

class FileConfigurationLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $fileDir = __DIR__ . '/../../../Fixtures/';
        $this->ini = $fileDir . 'file.ini';
        $this->notSupportedFile = $fileDir . 'file.xyz';
    }

    public function testCreateConfFile()
    {
        $conf = new FileConfigurationLoaderFactory($this->ini, array('ini'));

        $this->assertInstanceOf('Fakerino\Configuration\ConfigurationFile\IniConfigurationFile', $conf->load());

    }

    public function testFileNotFound()
    {
        $this->setExpectedException('Fakerino\DataSource\File\Exception\FileNotFoundException');
        $conf = new FileConfigurationLoaderFactory('file', array('ini'));
        $conf->load();
    }

    public function testConfNotSupported()
    {
        $this->setExpectedException('Fakerino\Configuration\Exception\ConfNotSupportedException');
        $conf = new FileConfigurationLoaderFactory($this->notSupportedFile, array('ini'));
        $conf->load();
    }
}
