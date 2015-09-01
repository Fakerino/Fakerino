<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Configuration;

use Fakerino\Configuration\FakerinoConfigurationLoader;
use Fakerino\DataSource\File\File;

class FakerinoConfigurationLoaderTest extends \PHPUnit_Framework_TestCase
{
    private $xmlFilePath;
    private $xmlFile;
    private $configurationLoader;

    public function setUp()
    {
        $fileDir = realpath(__DIR__ . '/../Fixtures') . '/';
        $this->xmlFilePath = $fileDir . 'file.xml';
        $this->xmlFile = new File($this->xmlFilePath);
        $this->configurationLoader = new FakerinoConfigurationLoader($this->xmlFile);
    }

    public function testConfiguration()
    {
        $this->assertInstanceOf('Fakerino\Configuration\FakerinoConfigurationLoader', $this->configurationLoader);
    }

    public function testConfigFilePath()
    {
        $this->assertEquals($this->xmlFilePath, $this->configurationLoader->getConfFilePath());
    }
}