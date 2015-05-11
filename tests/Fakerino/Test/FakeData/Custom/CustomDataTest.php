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

use Fakerino\FakeData\Custom\Integer;
use Fakerino\FakeData\Custom\RandomString;

class CustomDataTest extends \PHPUnit_Framework_TestCase
{
    public function testRandomString()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new RandomString());
    }

    public function testInteger()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Integer());
    }

}