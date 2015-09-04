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
use Fakerino\FakeData\Custom\Text;
use Fakerino\FakeData\Generator\FileFakeGenerator;

class FileFakeGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $conf = new FakerinoConf();
        $conf->loadConfiguration();
        $this->FileFakeGenerator = new FileFakeGenerator();
        $this->FileFakeGenerator->setCaller(new Text());
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
        $FileFakeGenerator->setCaller(new FileFake(__DIR__ . '/../Fixtures/file.txt'));
        $generatedString = $FileFakeGenerator->generate();

        $this->assertNotNull($generatedString);
        $this->assertInternalType('string', $generatedString);
    }
}