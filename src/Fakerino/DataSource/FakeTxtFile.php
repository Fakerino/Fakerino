<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\DataSource;

/**
 * Class FakeTxtFile,
 * handles file with fake data in txt format.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeTxtFile
{
    /**
     * Gets a txt file in a specified path.
     *
     * @param string $name
     * @param string $path
     *
     * @return File\File
     */
    public static function getSource($name, $path)
    {
        return FakeFileContainer::get($name . '.txt', $path);
    }
}