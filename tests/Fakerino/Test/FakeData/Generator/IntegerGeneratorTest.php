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

use Fakerino\FakeData\Generator\IntegerGenerator;

class IntegerGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->IntegerGenerator = new IntegerGenerator();
        $this->mockInteger = $this->getMockBuilder('Fakerino\FakeData\Generator\IntegerGenerator')
            ->setMethods(array('getOption'))
            ->getMock();
    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->IntegerGenerator);
    }

    /**
     * @dataProvider provider
     */
    public function testGenerateWithLengthOption($length, $type, $negative)
    {
        $map = array(
            array('length', $length),
            array('type', $type),
            array('negative', $negative)
        );
        $this->mockInteger->expects($this->exactly(3))
            ->method('getOption')
            ->will($this->returnValueMap($map));
        $fakeInteger = $this->mockInteger->generate();

        switch ($type) {
            case 'hex':
                $length+=2;
                break;
            case 'binary':
                $length+=2;
                break;
            case 'octal':
                $length+=1;
                break;
            case 'decimal':
                if ($negative) {
                    $length++;
                }
                break;
        }

        $this->assertEquals($length, strlen($fakeInteger), sprintf('the number %s %s length is not %s', $type, $fakeInteger, $length));
    }

    public function provider()
    {
        return array(
            array(2, 'decimal', false),
            array(3, 'decimal', true),
            array(1, 'hex', false),
            array(4, 'hex', true),
            array(5, 'binary', false),
            array(2, 'binary', true),
            array(8, 'octal', false),
            array(5, 'octal', true)
        );
    }
}