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

use Fakerino\Configuration\ConfigurationFile\PhpConfigurationFile;
use Fakerino\DataSource\File\File;

class PhpConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    public function testPhpConfFile()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $phpFilePath = $fileDir . 'file.php';
        $phpFile = new File($phpFilePath);
        $phpConf = new PhpConfigurationFile();
        $phpConf->loadConfiguration($phpFile);

        $this->assertInternalType('array', $phpConf->toArray());
    }

    public function testPhpWrongConfFile()
    {
        $this->setExpectedException('Fakerino\Configuration\Exception\ConfNotSupportedException');

        $fileDir = __DIR__ . '/../../Fixtures/';
        $phpFilePath = $fileDir . 'fileWrongConf.php';
        $phpFile = new File($phpFilePath);
        $phpConf = new PhpConfigurationFile();
        $phpConf->loadConfiguration($phpFile);

        $this->assertInternalType('array', $phpConf->toArray());
    }
}