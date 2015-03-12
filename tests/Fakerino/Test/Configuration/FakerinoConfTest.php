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

use Fakerino\Configuration\FakerinoConf;

class FakerinoConfTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->default = array(
            'supportedConfExts' => array('xml', 'php', 'ini'),
            'locale' => 'en_GB',
            'fakerinoTag' => 'fake',
            'fakeFilePath' => 'path'
        );
    }

    public function testMinimumDefaultValues()
    {
        FakerinoConf::loadConfiguration();
        $this->assertEquals(array_keys($this->default), array_keys(FakerinoConf::toArray()));

    }

    public function testAdditionalConfValues()
    {
        $testAdditional = array('test' => 1);
        $this->default = array_merge($testAdditional, $this->default);
        FakerinoConf::loadConfiguration($testAdditional);

        $this->assertEquals(array_keys($this->default), array_keys(FakerinoConf::toArray()));
    }
}
