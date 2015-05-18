<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\FakeHandler;

use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\FakeElement;
use Fakerino\Core\FakeHandler\FileFakerClass;

class FileFakerClassTest extends \PHPUnit_Framework_TestCase
{
    public function testHandler()
    {
        $handler = new FileFakerClass();
        $customClass = new FakeElement('Surname');

        $fakeFile = FakerinoConf::get('fakeFilePath')
            . DIRECTORY_SEPARATOR
            . FakerinoConf::get('locale')
            . DIRECTORY_SEPARATOR
            . strtolower($customClass->getName()) . '.txt';
        $fileContentRaw = file($fakeFile);
        $fileContent = array();
        foreach ($fileContentRaw as $val) {
            $fileContent[] = $this->cleanExtraChar($val);
        }
        $result = $handler->handle($customClass);
        $valueExists = in_array($result, $fileContent);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertInternalType('string', $result);
        $this->assertTrue($valueExists);
    }

    private function cleanExtraChar($val)
    {
        return preg_replace("/\r|\n/", "", $val);
    }
}