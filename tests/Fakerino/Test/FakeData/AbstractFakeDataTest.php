<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData;

use Fakerino\FakeData\AbstractFakeData;

class FakeDataA extends AbstractFakeData
{
    public function getDefaultOptions()
    {
        return array('defaultOption1' => 1,
            'defaultOption2' => 2);
    }

    public function getRequiredOptions()
    {
        return array('required1', 'required2');
    }
}

class AbstractFakeDataTest extends \PHPUnit_Framework_TestCase
{
    public function testValidRequiredOptions()
    {
        $fakeDataA = new FakeDataA(array('required1' => 1, 'required2' => 2));

        $this->assertInstanceOf('Fakerino\FakeData\FakedataInterface', $fakeDataA);
    }

    public function testOverrideDefaultOptions()
    {
        $overrideValue = 2;
        $overrideKey = 'defaultOption1';
        $fakeDataA = new FakeDataA(array('required1' => 1, 'required2' => 2, $overrideKey => $overrideValue));
        $fakeDataAOptions = $fakeDataA->getOptions();

        $this->assertEquals($overrideValue, $fakeDataAOptions[$overrideKey]);
    }

    public function testMissingRequiredOptionException()
    {
        $this->setExpectedException('Fakerino\FakeData\Exception\MissingRequiredOptionException');
        $fakeDataA = new FakeDataA(array('defaultOption3' => 3));
    }

    public function testInvalidOptionException()
    {
        $this->setExpectedException('Fakerino\FakeData\Exception\InvalidOptionException');
        $fakeDataA = new FakeDataA(array('required1' => 1, 'required2' => 2, 'otherOption'));
    }

    public function testGeneratedByCall()
    {
        $fakeDataA = new FakeDataA(array('required1' => 1, 'required2' => 2, 'generatedBy' => 'StringGenerator'));
        $generators = $fakeDataA->generatedBy();

        $this->assertEquals('Fakerino\FakeData\Data\StringGenerator', array_pop($generators));
    }
}
