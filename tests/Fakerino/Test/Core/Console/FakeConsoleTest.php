<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\Console;

use Fakerino\Core\Console\FakeConsole;

class FakeDataFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCallWithNoArgs()
    {
        $args = array(1 => 'surname');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertTrue(strlen($result) > 0);
    }

    public function testCallWithJsonArg()
    {
        $args = array(1 => 'surname', '2' => '-j');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertJson($result);
    }

    public function testCallWithNumArg()
    {
        $args = array(1 => 'surname', '2' => '-n', '3' => 2);
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertEquals($args[3], substr_count($result, "\n"));
    }

    public function testCallWithConfFile()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $testFile = $fileDir . 'file.ini';
        $args = array('1' => '-c', '2' => $testFile, '3' => 'surname');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertTrue(strlen($result) > 0);
    }

    public function testCallHelper()
    {
        $args = array('1' => '-h');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertTrue(strlen($result) > 0);
    }

    public function testCallLocale()
    {
        $args = array('1' => '-l', '2' => 'en-GB', '3' => 'test');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertTrue(strlen($result) > 0);
    }

    public function testCallWithMultipleArgs()
    {
        $args = array(1 => 'surname', '2' => '-n', '3' => 2, '4' => '-j');
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertEquals($args[3], count(json_decode($result)));
    }
}