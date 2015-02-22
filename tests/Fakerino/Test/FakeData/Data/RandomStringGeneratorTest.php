<?php
namespace Fakerino\Test\FakeData\Data;

use Fakerino\FakeData\Data\RandomStringGenerator;
use Fakerino\FakeData\Data\GenericString;

class RandomStringGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->randomStringGenerator = new RandomStringGenerator(new GenericString());
    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->randomStringGenerator);
    }
    public function testGenerate()
    {
        $randomString = $this->randomStringGenerator->generate();

        $this->assertNotNull($randomString);
        $this->assertInternalType('string', $randomString);
    }
}

