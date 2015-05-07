<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\FakeData\Exception;

use Fakerino\FakeData\Exception\InvalidOptionException;
use Fakerino\FakeData\Exception\MissingRequiredOptionException;

class FakeDataExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidOptionException()
    {
        $e = new InvalidOptionException('foo');

        $this->assertEquals('The format of the option "foo" is invalid', $e->getMessage(), 'A message should be generated');
    }

    public function testMissingRequiredOptionException()
    {
        $e = new MissingRequiredOptionException('foo');

        $this->assertEquals('The required option "foo" is missing', $e->getMessage(), 'A message should be generated');
    }
}