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
    public function testIniToArray()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $iniFilePath = $fileDir . 'file.ini';
        $iniFile = new File($iniFilePath);
        $iniConf = new IniConfigurationFile();
        $iniConf->loadConfiguration($iniFile);

        $this->assertInternalType('array', $iniConf->toArray());
    }
}