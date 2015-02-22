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

        $this->assertInternalType('array', $xmlConf->toArray());
    }
}
