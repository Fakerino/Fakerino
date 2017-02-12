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
use Fakerino\Core\Database\DoctrineLayer;

/**
 * @group console
 */
class FakeConsoleTest extends \PHPUnit_Framework_TestCase
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

    public function testFillTable()
    {
        $testTable = 'testTable';
        $sql = "CREATE TABLE IF NOT EXISTS`" . $testTable . "` (
                `numberPk`	INTEGER,
                `number`	INTEGER,
                `text`	TEXT,
                `surname`	TEXT,
                `description`	BLOB,
                PRIMARY KEY(numberPk)
                )";
        $db = __DIR__ . '/../../Fixtures/test.sqlite';
        $connectionParams = array(
            'path' => $db,
            'driver' => 'pdo_sqlite',
        );
        $num = 3;
        $dLayer = new DoctrineLayer($connectionParams);
        $dLayer->connect();
        DoctrineLayer::$conn->query($sql);
        $fileDir = __DIR__ . '/../../Fixtures/';
        $testFile = $fileDir . 'file.php';
        $args = array('1' => '-c', '2' => $testFile, '3' => '-t', '4' => $testTable, '5' => '-n', '6' => $num);
        $fakeConsole = new FakeConsole($args);
        $result = $fakeConsole->run();
        $res = DoctrineLayer::$conn->query("SELECT COUNT(*) FROM " . $testTable);
        $total = $res->fetchColumn(0);

        $this->assertEquals($num, $total);
        $this->assertNull($result);
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

    public function testCallTemplateFile()
    {
        $templateFile = __DIR__ . '/../../Fixtures/template.html';
        $args = array(1 => '-s', '2' => $templateFile);
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertInternalType('string', $result);
        $this->assertNotContains('{{ surname }}', $result);
    }

    public function testCallTemplateString()
    {
        $templateString = 'Hello Mr {{ surname }}';
        $args = array(1 => '-s', '2' => $templateString);
        $fakeConsole = new FakeConsole($args);
        $result = (string)$fakeConsole->run();

        $this->assertInternalType('string', $result);
        $this->assertNotContains('{{ surname }}', $result);
    }

    public static function tearDownAfterClass()
    {
        DoctrineLayer::$conn = null;
        $dbFile = __DIR__ . '/../../Fixtures/test.sqlite';
        unlink($dbFile);
    }

}