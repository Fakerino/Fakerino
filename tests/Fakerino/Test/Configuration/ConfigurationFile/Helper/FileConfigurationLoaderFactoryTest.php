<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
