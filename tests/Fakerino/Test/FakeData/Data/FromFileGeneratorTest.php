<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Data;

use Fakerino\FakeData\Data\FromFileGenerator;
use Fakerino\FakeData\Data\GenericString;
use Fakerino\FakeData\Data\Surname;
use Fakerino\Configuration\FakerinoConf;

class FromFileGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->defaultConf = new FakerinoConf();
        $this->defaultConf->loadConfiguration();
        $this->fromFileGenerator = new FromFileGenerator(new GenericString(), $this->defaultConf);
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->fromFileGenerator);
    }

    public function testReturnNull()
    {
        $this->assertNull($this->fromFileGenerator->generate());
    }

    public function testReturnRandomLine()
    {
        $fromFileGenerator = new FromFileGenerator(new Surname(), $this->defaultConf);
        $generatedString = $fromFileGenerator->generate();

        $this->assertNotNull($generatedString);
        $this->assertInternalType('string', $generatedString);
    }
}

