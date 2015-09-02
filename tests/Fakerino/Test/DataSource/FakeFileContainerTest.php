<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\DataSource;

use Fakerino\DataSource\FakeFileContainer;
use Fakerino\DataSource\File\File;

class FakeFileContainerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filePath = __DIR__ . '/../Fixtures/file.txt';
    }

    public function testGetNotExistedFile()
    {
        $container = new FakeFileContainer();

        $this->assertFalse($container->get('wrongPath/foo.txt'));
    }

    public function testContainer()
    {
        $container = new FakeFileContainer();

        $this->assertInstanceOf('\SplFileInfo', $container->get($this->filePath));
    }

    public function testAddMethod()
    {
        $container = new FakeFileContainer();
        $file = new File($this->filePath);
        $container->add('file', $file);

        $this->assertInstanceOf('\SplFileInfo', $container->get($this->filePath));
    }
}