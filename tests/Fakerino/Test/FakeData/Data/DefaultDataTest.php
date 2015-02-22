<?php

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

