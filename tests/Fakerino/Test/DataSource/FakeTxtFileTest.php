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

use Fakerino\DataSource\FakeTxtFile;

class FakeFileContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSource()
    {
        $container = new FakeTxtFile();
        $fileDir = __DIR__ . '/../Fixtures/';

        $this->assertInstanceOf('\SplFileInfo', $container->getSource('file', $fileDir));
    }
}
