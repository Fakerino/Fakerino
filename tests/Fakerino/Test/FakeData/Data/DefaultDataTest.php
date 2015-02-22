<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Data;

use Fakerino\FakeData\Data\GenericString;
use Fakerino\FakeData\Data\Name;
use Fakerino\FakeData\Data\Surname;

class DefaultDataTest extends \PHPUnit_Framework_TestCase
{
    public function testGenericString()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new GenericString());
    }

    public function testName()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Name());
    }

    public function testSurname()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Surname());
    }
}

