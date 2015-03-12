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

use Fakerino\FakeData\Core\GenericString;
use Fakerino\FakeData\Generator\RandomStringGenerator;

class RandomStringGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->randomStringGenerator = new RandomStringGenerator(new GenericString());
    }

    public function testRandomStringGeneratorConstructor()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataGeneratorInterface', $this->randomStringGenerator);
    }
    /*
        public function testGenerate()
        {
            $randomString = $this->randomStringGenerator->generate();

            $this->assertNotNull($randomString);
            $this->assertInternalType('string', $randomString);
        }

        public function testGenerateWithOption()
        {
            $length = 10;
            $randomStringGenerator = new RandomStringGenerator(new GenericString(array('length' => $length)));
            $randomString = $randomStringGenerator->generate();

            $this->assertEquals($length, strlen($randomString));
        }
    */
}

