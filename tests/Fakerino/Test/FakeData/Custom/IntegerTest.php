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

use Fakerino\FakeData\Custom\Integer;

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    public function testInteger()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Integer());
    }

    public function getDefaultOptionString()
    {
        $data = new Text();

        $this->assertArrayHasKey('length', $data->getDefaultOptions());
        $this->assertArrayHasKey('negative', $data->getDefaultOptions());
        $this->assertArrayHasKey('type', $data->getDefaultOptions());
    }
}