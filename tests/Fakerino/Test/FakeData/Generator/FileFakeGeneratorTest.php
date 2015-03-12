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

use Fakerino\Configuration\FakerinoConf;
use Fakerino\FakeData\Core\FileFake;
use Fakerino\FakeData\Core\GenericString;
use Fakerino\FakeData\Generator\FileFakeGenerator;

class FileFakeGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        FakerinoConf::loadConfiguration();
        $this->FileFakeGenerator = new FileFakeGenerator();
        $this->FileFakeGenerator->setCaller(new GenericString());
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->FileFakeGenerator);
    }

    public function testReturnNull()
    {
        $this->assertNull($this->FileFakeGenerator->generate());
    }

    public function testReturnRandomLine()
    {
        $FileFakeGenerator = new FileFakeGenerator();
        $FileFakeGenerator->setCaller(new FileFake('Surname'));
        $generatedString = $FileFakeGenerator->generate();

        $this->assertNotNull($generatedString);
        $this->assertInternalType('string', $generatedString);
    }

}

