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

use Fakerino\FakeData\Custom\Date;

class DateTest extends \PHPUnit_Framework_TestCase
{
    public function testDate()
    {
        $this->assertInstanceOf('Fakerino\FakeData\FakeDataInterface', new Date());
    }

    public function getDefaultOptionString()
    {
        $data = new Text();

        $this->assertArrayHasKey('format', $data->getDefaultOptions());
        $this->assertArrayHasKey('startDate', $data->getDefaultOptions());
        $this->assertArrayHasKey('endDate', $data->getDefaultOptions());
    }
}
