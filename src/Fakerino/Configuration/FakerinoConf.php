<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration;

use Fakerino\Configuration\Exception\ConfValueNotFoundException;

/**
 * Class FakerinoConf,
 * handles the global Fakerino configuration.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakerinoConf
{
    /**
     * @var array
     */
    private static $conf;


    /**
     * Loads the default configuration if it's not present a custom one.
     *
     * @param array $conf
     */
    public static function loadConfiguration(array $conf = array())
    {
        if (empty($conf)) {
            self::$conf = self::loadDefault();
        } else {
            self::$conf = array_merge($conf, self::loadDefault());
        }
    }

    /**
     * Returns a configuration value.
     *
     * @param string $value
     *
     * @return mixed
     * @throws ConfValueNotFoundException
     */
    public static function get($value)
    {
        if (!array_key_exists($value, self::$conf)) {
            throw new ConfValueNotFoundException($value);
        }

        return self::$conf[$value];
    }

    /**
     * Sets a configuration value.
     *
     * @param string        $key
     * @param string|array  $val
     */
    public static function set($key, $val)
    {
        self::$conf[$key] = $val;
    }

    /**
     * Initializes the default values.
     *
     * @return array
     */
    private static function loadDefault()
    {
        return array(
            'supportedConfExts' => array('xml', 'php', 'ini'),
            'locale' => 'en_GB',
            'fakerinoTag' => 'fake',
            'fakeFilePath' => __DIR__
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
                . '/data'
        );
    }

    /**
     * Returns the configuration in an array.
     *
     * @return array
     */
    public static function toArray()
    {
        return self::$conf;
    }
}
