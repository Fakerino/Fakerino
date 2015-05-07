<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test;

use Fakerino\Fakerino;
use Fakerino\Helper\FileLocator;

class FakerinoTest extends \PHPUnit_Framework_TestCase
{
    private $testFile;

    public function setUp()
    {
        $fileDir = __DIR__ . '/Fixtures/';
        $this->testFile = $fileDir . 'file.ini';
    }

    public function testDefaultConfigurationSetUp()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create($this->testFile));
    }

    public function testConfigurationNotProvided()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create());
    }
}