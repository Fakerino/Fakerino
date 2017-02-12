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
    private $fileDir;

    public function setUp()
    {
        $this->fileDir = __DIR__ . '/Fixtures/';
        $this->testFile = $this->fileDir . 'file.ini';
    }

    public function testCustomConfigurationSetUp()
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
                array('fake' => array('fakeSurname' => array('surname'))),
                'fakeSurname',
                '/[A-Z][a-z].*[^\n]/',
            ),
        );
    }

    /**
     * @group important
     */
    public function testMultipleNestedFakes()
    {
        $fakerino = Fakerino::create(array('fake' => array('fakeSurname' => array('surname'))));
        $fakerino->fake('fakeSurname')->toArray();
        $fakerino = Fakerino::create($this->fileDir . '/file.yml');
        $result = $fakerino->fake('fakeFamily')->toArray();

        $this->assertEquals(3, count($result[0][0]));
        $this->assertEquals(3, count($result[0][1]));
    }
}