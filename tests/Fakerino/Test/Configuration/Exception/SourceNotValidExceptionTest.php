<?php

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
