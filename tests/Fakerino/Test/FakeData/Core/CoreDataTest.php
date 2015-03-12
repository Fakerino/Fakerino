<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Core;

use Fakerino\FakeData\Core\FileFake;
use Fakerino\FakeData\Core\GenericString;

class CoreDataTest extends \PHPUnit_Framework_TestCase
{
    public function testFileFake()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new FileFake());
    }

    public function testGenericString()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new GenericString());
    }

}

