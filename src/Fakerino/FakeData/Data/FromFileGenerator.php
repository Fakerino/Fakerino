<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Data;

use Fakerino\DataSource\FakeTxtFile;
use Fakerino\FakeData\AbstractFakeDataGenerator;

/**
 * Class FromFileGenerator,
 * gets fake data from a file.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FromFileGenerator extends AbstractFakeDataGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $callerClass = new \ReflectionClass($this->caller);
        $callerName = $callerClass->getShortName();
        $path = $this->conf->get('fakeFilePath')
            . DIRECTORY_SEPARATOR
            . $this->conf->get('locale')
            . DIRECTORY_SEPARATOR;
        if ($fakeFile = FakeTxtFile::getSource($callerName, $path)) {
            $lines = file($fakeFile);
            $element = $lines[array_rand($lines)];

            return preg_replace("/\r|\n/", "", $element);
        } else {

            return null;
        }
    }
}

