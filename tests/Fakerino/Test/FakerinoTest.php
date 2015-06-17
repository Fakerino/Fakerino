<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test;

use Fakerino\Fakerino;

class FakerinoTest extends \PHPUnit_Framework_TestCase
{
    private $testFile;

    public function setUp()
    {
        $fileDir = __DIR__ . '/Fixtures/';
        $this->testFile = $fileDir . 'file.ini';
    }

    public function testDefaultConfigurationSetUp()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create($this->testFile));
    }

    public function testConfigurationNotProvided()
    {
        $this->assertInstanceOf('Fakerino\Core\FakeDataFactory', Fakerino::create());
    }

    public function testGetConfiguration()
    {
        Fakerino::create();

        $this->assertInternalType('array', Fakerino::getConfig());
    }

    /**
     * @dataProvider provider
     */
    public function testFakeData($conf, $element, $expected)
    {
        $fakerino = Fakerino::create($conf);
        $result = $fakerino->fake($element)->__toString();

        $this->assertRegExp($expected, $result, sprintf("The result '%s' of '%s' doesn't match the expected regex '%s'", $result, serialize($element), $expected));
    }

    /**
     * @dataProvider provider
     */
    public function testFakeWithSeed($conf, $element)
    {
        $fakerino = Fakerino::create($conf);
        mt_srand(2);
        $result1 = $fakerino->fake($element)->__toString();
        mt_srand(2);
        $result2 = $fakerino->fake($element)->__toString();

        $this->assertEquals($result1, $result2, sprintf("The first result '%s' and the second '%s'", $result1, $result2));
    }

    public function provider()
    {
        return array(
            array(null, array('text' => array('length' => 10)), '/\w{10}/'),
            array(null, 'surname', '/[^0-9.]/'),
            array(null, 'integer', '/[0-9]/'),
            array(null, 'lorem', '/\w/'),
            array(null, 'date', '/[\d-]/'),
            array(
                array(
                    'fake' => array('fakeTest' =>
                                array('surname')
                    )
                )
                , 'fakeTest', '/[A-Z][a-z].*[^\n]/'
            )
        );
    }
}