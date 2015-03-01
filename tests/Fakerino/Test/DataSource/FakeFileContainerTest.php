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

class FakeTxtFileTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNotExistedFile()
    {
        $container = new FakeFileContainer();

        $this->assertFalse($container->get('test', 'path'));
    }

    public function testContainer()
    {
        $container = new FakeFileContainer();
        $fileDir = __DIR__ . '/../Fixtures/';

        $this->assertInstanceOf('\SplFileInfo', $container->get('file.txt', $fileDir));
    }
}
