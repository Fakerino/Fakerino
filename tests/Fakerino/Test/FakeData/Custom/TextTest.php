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

use Fakerino\FakeData\Custom\Text;

class TextTest extends \PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Text());
    }

    public function getDefaultOptionString()
    {
        $data = new Text();

        $this->assertArrayHasKey('length', $data->getDefaultOptions());
        $this->assertArrayHasKey('addChar', $data->getDefaultOptions());
    }
}