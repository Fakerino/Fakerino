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

use Fakerino\DataSource\File\File;

/**
 * Class FakeFileContainer,
 * is a container that stores File object,
 * it's useful for avoiding multiple construction of a same object.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeFileContainer
{
    /**
     * @var array
     */
    protected static $files = array();

    /**
     * Adds a file to the container.
     *
     * @param string $name
     * @param File   $file
     */
    public static function add($name, File $file)
    {
        self::$files[$name] = $file;
    }

    /**
     * Gets a file from container, 
     * or create a new one if not present.
     *
     * @param string $name
     * @param string $path
     *
     * @return File
     */
    public static function get($name, $path)
    {
        if (!array_key_exists($name, static::$files)) {
            try {
                $file = new File($path . $name);
            } catch (\Exception $e) {
                $file = false;
            }

            static::$files[$name] = $file;
        }

        return static::$files[$name];
    }
}
