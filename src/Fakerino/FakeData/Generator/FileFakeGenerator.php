<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Generator;

use Fakerino\Configuration\FakerinoConf;
use Fakerino\DataSource\FakeTxtFile;
use Fakerino\FakeData\AbstractFakeDataGenerator;

/**
 * Class FileFakeGenerator,
 * gets fake data from a file.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileFakeGenerator extends AbstractFakeDataGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $fileName = strtolower($this->caller->getOption('filename'));
        $path = FakerinoConf::get('fakeFilePath')
            . DIRECTORY_SEPARATOR
            . FakerinoConf::get('locale')
            . DIRECTORY_SEPARATOR;
        if ($fakeFile = FakeTxtFile::getSource($fileName, $path)) {
            $lines = file($fakeFile);
            $element = $lines[array_rand($lines)];

            return preg_replace("/\r|\n/", "", $element);
        } else {

            return;
        }
    }
}