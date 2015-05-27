<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\RegEx\Exception;

use Fakerino\Core\RegEx\Exception\InvalidRegexException;

/**
 * Class InvalidRegexException,
 * appears when the format of the regular expression is not valid.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class InvalidRegexExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testInvalidRegexException()
    {
        $e = new InvalidRegexException('foo');

        $this->assertEquals('The format of the regular expression "foo" is invalid', $e->getMessage(), 'A message should be generated');
    }
}