<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\FakeHandler;
use Fakerino\Configuration\FakerinoConf;

/**
 * Class FileFakerClass,
 * processes the request with an existent data fake file.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileFakerClass extends Handler
{

    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        $fakeFilePath = FakerinoConf::get('fakeFilePath')
            . DIRECTORY_SEPARATOR
            . FakerinoConf::get('locale')
            . DIRECTORY_SEPARATOR
            . $this->createFilename($data);
        if (file_exists($fakeFilePath)) {

            return $this->getOuput('Fakerino\\FakeData\\Core\\FileFake', $data);
        }

        return null;
    }

    private function createFilename($name)
    {
        return strtolower($name) . '.txt';
    }
}