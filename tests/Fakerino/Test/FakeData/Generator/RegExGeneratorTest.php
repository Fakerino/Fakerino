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

use Fakerino\Core\RegEx\RegRevGenerator;
use Fakerino\FakeData\Generator\RegExGenerator;

class RegExGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->generator = new RegExGenerator();
        $this->mockInteger = $this->getMockBuilder('Fakerino\FakeData\Generator\RegExGenerator')
            ->setMethods(array('getOption'))
            ->getMock();
    }

    public function testGeneration()
    {
        $length = 3;
        $expr = '\d{'.$length.'}';
        $map = array(
            array('regexgenerator', new RegRevGenerator()),
            array('expression', $expr),
        );
        $this->mockInteger->expects($this->exactly(2))
            ->method('getOption')
            ->will($this->returnValueMap($map));
        $fakeData = $this->mockInteger->generate();

        $this->assertEquals($length, strlen($fakeData));
    }
}