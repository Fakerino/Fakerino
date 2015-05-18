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

use Fakerino\Configuration\Exception\ConfValueNotFoundException;

class ConfValueNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testConfNotSupportedException()
    {
        $value = 'test';
        $e = new ConfValueNotFoundException($value);
        $message = sprintf('
            The configuration value "%s" is not present,
            be sure the configuration is loaded and the value is defined
            ', $value);

        $this->assertEquals($message, $e->getMessage(), 'A message should be generated');
    }
}