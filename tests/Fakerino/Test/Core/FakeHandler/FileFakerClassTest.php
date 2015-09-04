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

/**
 * @group handler
 */
class FileFakerClassTest extends \PHPUnit_Framework_TestCase
{
    public function testHandler()
    {
        $elementToFake = 'Surname';
        $fakerinoDefaultConf = new FakerinoConf();
        $fakerinoDefaultConf->loadConfiguration();
        $fileFakePath = $this->getFileFakePath($fakerinoDefaultConf);
        $fakeFile = $fileFakePath
            . strtolower($elementToFake) . '.txt';

        $handler = new FileFakerClass($fileFakePath);
        $customClass = new FakeElement($elementToFake);
        $fileContent = $this->getFileContent($fakeFile);

        $result = $handler->handle($customClass);
        $isResultValueExistsInFile = in_array($result, $fileContent);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertInternalType('string', $result);
        $this->assertTrue($isResultValueExistsInFile);
    }

    private function cleanExtraChar($val)
    {
        return preg_replace("/\r|\n/", "", $val);
    }

    private function getFileFakePath($fakerinoDefaultConf)
    {
        return $fakerinoDefaultConf->get('fakeFilePath')
        . DIRECTORY_SEPARATOR
        . $fakerinoDefaultConf->get('locale')
        . DIRECTORY_SEPARATOR;
    }

    private function getFileContent($fakeFile)
    {
        $fileContentRaw = file($fakeFile);
        $fileContent = array();
        foreach ($fileContentRaw as $val) {
            $fileContent[] = $this->cleanExtraChar($val);
        }

        return $fileContent;
    }
}