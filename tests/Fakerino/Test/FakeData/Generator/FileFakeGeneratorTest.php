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

use Fakerino\FakeData\Core\FileFake;
use Fakerino\FakeData\Custom\Text;
use Fakerino\FakeData\Generator\FileFakeGenerator;

class FileFakeGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->fileFakeGenerator = new FileFakeGenerator();
        $this->fileFakeGenerator->setCaller(new Text());
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->fileFakeGenerator);
    }

    public function testReturnNull()
    {
        $this->assertNull($this->fileFakeGenerator->generate());
    }

    public function testReturnRandomLine()
    {
        $fileFakeGenerator = new FileFakeGenerator();
        $fileFakeGenerator->setCaller(new FileFake(__DIR__ . '/../Fixtures/file.txt'));
        $generatedString = $fileFakeGenerator->generate();
        $this->assertNotNull($generatedString);
        $this->assertInternalType('string', $generatedString);
    }
}