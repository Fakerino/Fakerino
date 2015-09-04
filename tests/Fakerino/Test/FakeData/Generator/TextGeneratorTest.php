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

use Fakerino\FakeData\Generator\TextGenerator;

class TextGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->randomStringGenerator = new TextGenerator();
        $this->mockCaller = $this->getMockBuilder('Fakerino\FakeData\FakeDataInterface')
            ->getMock();
        $this->randomStringGenerator->setCaller($this->mockCaller);

    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->randomStringGenerator);
    }

    public function testGenerate()
    {
        $this->mockCaller->method('getOption')
            ->willReturn(null);
        $randomString = $this->randomStringGenerator->generate();

        $this->assertNotNull($randomString);
        $this->assertInternalType('string', $randomString);
    }

    public function testGenerateWithLengthOption()
    {
        $length = 10;
        $map = array(
            array('length', $length),
            array('addChars', 'test')
        );
        $this->mockCaller->expects($this->exactly(2))
            ->method('getOption')
            ->will($this->returnValueMap($map));
        $randomString = $this->randomStringGenerator->generate();

        $this->assertEquals($length, strlen($randomString));
    }
}