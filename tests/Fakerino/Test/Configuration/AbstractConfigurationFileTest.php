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

use Fakerino\Configuration\AbstractConfigurationFile;
use Fakerino\DataSource\File\File;

class ConcreteConfiguration extends AbstractConfigurationFile
{
    public function toArray()
    {
    }
}

class AbstractConfigurationFileTest extends \PHPUnit_Framework_TestCase
{
    private $xmlFilePath;
    private $xmlFile;
    private $concreteConfiguration;

    public function setUp()
    {
        $fileDir = realpath(__DIR__ . '/../Fixtures') . '/';
        $this->xmlFilePath = $fileDir . 'file.xml';
        $this->xmlFile = new File($this->xmlFilePath);
        $this->concreteConfiguration = new ConcreteConfiguration();
    }

    public function testConfiguration()
    {
        $this->assertInstanceOf('Fakerino\Configuration\ConfigurationInterface', $this->concreteConfiguration);
    }

    public function testConfigFilePath()
    {
        $this->concreteConfiguration->loadConfiguration($this->xmlFile);
        $this->assertEquals($this->xmlFilePath, $this->concreteConfiguration->getConfFilePath());
    }
}
