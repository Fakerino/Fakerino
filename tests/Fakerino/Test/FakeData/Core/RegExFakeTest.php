<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Core;

use Fakerino\FakeData\Core\RegExFake;

class RegexFakeTest extends \PHPUnit_Framework_TestCase
{
    public function testRegexFake()
    {
        $regexFake = new RegexFake();
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', $regexFake);
    }

    public function testOptions()
    {
        $options = array(
            'regexgenerator' => 'generator',
            'expression' => 'expression'
        );
        $regexFake = new RegexFake($options);

        $this->assertEquals($options['regexgenerator'], $regexFake->getOption('regexgenerator'));
        $this->assertEquals($options['expression'], $regexFake->getOption('expression'));
    }

    public function testGeneratedBy()
    {
        $regexFake = new RegexFake();
        $generatedBy = $regexFake->generatedBy();

        $this->assertEquals('Fakerino\\FakeData\\Generator\\RegExGenerator', $generatedBy);
    }

    public function testGetRequiredOptions()
    {
        $regexFake = new RegexFake();

        $this->assertNull($regexFake->getDefaultOptions());
    }

    public function testGetDefaultOptions()
    {
        $regexFake = new RegexFake();

        $this->assertNull($regexFake->getRequiredOptions());
    }
}