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

/**
 * Class FileFakerClass,
 * processes the request with an existent data fake file.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class FileFakerClass extends Handler
{

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }
    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        $elementName = $data->getName();
        $fakeFilePath = $this->filePath
            . $this->createFilename($elementName);
        if (file_exists($fakeFilePath)) {

            return $this->getOutput('Fakerino\\FakeData\\Core\\FileFake', $fakeFilePath);
        }

        return;
    }

    private function createFilename($name)
    {
        return strtolower($name) . '.txt';
    }
}