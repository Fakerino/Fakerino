<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Generator;

use Fakerino\FakeData\Generator\RandomStringGenerator;

class RandomStringGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->randomStringGenerator = new RandomStringGenerator();
        $this->mockRandomString = $this->getMockBuilder('Fakerino\FakeData\Generator\RandomStringGenerator')
            ->setMethods(array('getOption'))
            ->getMock();
    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->randomStringGenerator);
    }

    public function testGenerate()
    {
        $this->mockRandomString->method('getOption')
            ->willReturn(null);
        $randomString = $this->mockRandomString->generate();

        $this->assertNotNull($randomString);
        $this->assertInternalType('string', $randomString);
    }

    public function testGenerateWithLengthOption()
    {
        $length = 10;
        $map = array(
            array('length', $length),
            array('addChars', null)
        );
        $this->mockRandomString->expects($this->exactly(2))
            ->method('getOption')
            ->will($this->returnValueMap($map));
        $randomString = $this->mockRandomString->generate();

        $this->assertEquals($length, strlen($randomString));
    }
}