<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Configuration\Exception;

use Fakerino\Configuration\Exception\SourceNotValidException;

class SourceNotValidExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testSourceNotValidException()
    {
        $e = new SourceNotValidException();

        $this->assertEquals('The source specified is not valid', $e->getMessage(), 'A message should be generated');
    }
}