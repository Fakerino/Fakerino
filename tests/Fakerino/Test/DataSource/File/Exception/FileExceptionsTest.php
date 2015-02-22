<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\DataSource\File\Exception;

use Fakerino\DataSource\File\Exception\FileEmptyException;
use Fakerino\DataSource\File\Exception\FileLineNotFoundException;
use Fakerino\DataSource\File\Exception\FileNotFoundException;

class FileExceptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testFileEmptyException()
    {
        $e = new FileEmptyException('file.txt');

        $this->assertEquals('The file "file.txt" is empty', $e->getMessage(), 'A message should be generated');
    }

    public function testFileLineNotFoundException()
    {
        $e = new FileLineNotFoundException(1, 'file.txt');

        $this->assertEquals('The line "1" does not exist in file "file.txt"', $e->getMessage(), 'A message should be generated');
    }

    public function testFileNotFoundException()
    {
        $e = new FileNotFoundException('file.txt');

        $this->assertEquals('The file "file.txt" does not exist', $e->getMessage(), 'A message should be generated');
    }
}
