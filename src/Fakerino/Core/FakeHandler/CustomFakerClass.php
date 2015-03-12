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
 * Class CustomFakerClass,
 * processes the request to the custom classes,
 * if defined.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class CustomFakerClass extends Handler
{
    /**
     * @var array custom class container
     */
    private $defaultClasses = array();

    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        $this->setUpDefaultClass();
        if (in_array($data, $this->defaultClasses)) {

            return $this->getOuput($this->getDataClass($data));
        }

        return null;
    }

    private function setUpDefaultClass()
    {
        $customFileDir = __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR
            . 'FakeData'
            . DIRECTORY_SEPARATOR
            . 'Custom';

        foreach (new \DirectoryIterator($customFileDir) as $file) {
            if ($file->isDot()) {
                continue;
            }
            $classFile = $file->getFilename();
            $this->defaultClasses[] = str_replace('.php', '', $classFile);
        }
    }

    private function getDataClass($className)
    {
        return 'Fakerino\\FakeData\\Custom\\' . $className;
    }
}
