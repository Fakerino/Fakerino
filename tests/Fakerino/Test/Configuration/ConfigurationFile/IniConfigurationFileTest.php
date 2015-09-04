<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationFile\IniConfigurationFile;
use Fakerino\DataSource\File\File;

class IniConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testIniConfFile()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $iniFilePath = $fileDir . 'file.ini';
        $iniFile = new File($iniFilePath);
        $iniConf = new IniConfigurationFile($iniFile);
        $result = $iniConf->toArray();

        $this->assertInternalType('array', $result);
        $this->assertNotEmpty($result);
    }

    public function testEmptyIniConfFile()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $iniFilePath = $fileDir . 'emptyFile.ini';
        $iniFile = new File($iniFilePath);
        $iniConf = new IniConfigurationFile($iniFile);
        $result = $iniConf->toArray();

        $this->assertInternalType('array', $result);
        $this->assertEmpty($result);
    }
}