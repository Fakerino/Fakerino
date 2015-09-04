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

use Fakerino\FakeData\Generator\DateGenerator;

class DateGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->dateGenerator = new DateGenerator();
        $this->mockCaller = $this->getMockBuilder('Fakerino\FakeData\FakeDataInterface')
            ->getMock();
        $this->dateGenerator->setCaller($this->mockCaller);
    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->dateGenerator);
    }

    /**
     * @dataProvider provider
     */
    public function testGenerateWithLengthOption($format, $startDate, $endDate, $pattern)
    {
        $map = array(
            array('format', $format),
            array('startDate', $startDate),
            array('endDate', $endDate)
        );
        $this->mockCaller->expects($this->exactly(3))
            ->method('getOption')
            ->will($this->returnValueMap($map));
        $fakeDate = $this->dateGenerator->generate();

        $this->assertTrue((bool)preg_match($pattern, $fakeDate), sprintf('The date %s doesn\'t match the expression %s', $fakeDate, $pattern));
    }

    public function provider()
    {
        return array(
            array('Y-m-d', '1900-01-01', '1981-01-28', '/\d{4}-\d{2}-\d{2}/'),
            array('d-m-y', '1900-01-01', '2015-08-27', '/\d{2}-\d{2}-\d{2}/'),
            array('D-M-y', '1980-01-31', '2000-01-01', '/\w{3}-\w{3}-\d{2}/'),
            array('Y-m-d H:i:s', '1969-01-01', '2015-02-29', '/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}/'),
            array('H:i:s', '1900-01-01', '2015-02-29', '/\d{2}:\d{2}:\d{2}/'),
        );
    }
}