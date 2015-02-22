<?php

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
