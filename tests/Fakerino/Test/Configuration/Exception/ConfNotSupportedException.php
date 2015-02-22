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

use Fakerino\Configuration\Exception\ConfNotSupportedException;

class ConfNotSupportedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testConfNotSupportedException()
    {
        $e = new ConfNotSupportedException('file');

        $this->assertEquals('The configuration file "file" is not supported', $e->getMessage(), 'A message should be generated');
    }
}
