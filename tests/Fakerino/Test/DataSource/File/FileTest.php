<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\DataSource\File;

use Fakerino\DataSource\File\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $fileDir = __DIR__ . '/../../Fixtures/';
        $this->emptyFile = $fileDir . 'emptyFile.ini';
        $this->testFile = $fileDir . 'file.ini';
        $this->file = new File($this->testFile);
    }

    public function testFileGetFileName()
    {
        $splFile = new \SplFileInfo($this->testFile);

        $this->assertEquals($splFile->getFilename(), $this->file->getFileName());
    }

    public function testFileGetTxtMimeType()
    {
        $this->file = new File($this->testFile);

        $this->assertEquals('text/plain', $this->file->getMimeType());
    }

    public function testFileGetExtension()
    {
        $splFile = new \SplFileInfo($this->testFile);
        $this->file = new File($this->testFile);

        $this->assertEquals($splFile->getExtension(), $this->file->getExtension());
    }

    public function testFileGetContent()
    {
        $content = file_get_contents($this->testFile);
        $this->file = new File($this->testFile);

        $this->assertEquals($content, $this->file->getContent());
    }

    public function testFileNotFoundException()
    {
        $this->setExpectedException('Fakerino\DataSource\File\Exception\FileNotFoundException');

        $this->file = new File('file');
    }

    public function testFileGetConentEmptyException()
    {
        $this->setExpectedException('Fakerino\DataSource\File\Exception\FileEmptyException');

        $this->file = new File($this->emptyFile);
        $this->file->getContent();
    }

    public function testFileReadLineNotFoundException()
    {
        $this->setExpectedException('Fakerino\DataSource\File\Exception\FileLineNotFoundException');

        $this->file = new File($this->testFile);
        $this->file->readLine(100);
    }

    public function testFileReadLine()
    {
        $this->file = new File($this->testFile);

        $this->assertNotNull($this->file->readLine(0));
    }
}