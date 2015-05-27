<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\RegEx;

use Fakerino\Core\RegEx\RegRevGenerator;

class RegRevGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $generator = new RegRevGenerator();
        $length = 3;
        $expr = '/\d{'.$length.'}/';

        $this->assertEquals($length, strlen($generator->generate($expr)));
    }
}