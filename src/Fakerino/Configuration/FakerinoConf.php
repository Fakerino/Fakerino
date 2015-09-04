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
final class FakerinoConf
{
    /**
     * @var array
     */
    private $conf;

    /**
     * @param array $conf
     */
    public function __construct(array $conf = null)
    {
        $this->conf = $conf;
    }

    /**
     * Loads the default configuration if it's not present a custom one.
     *
     * @return array
     */
    public function loadConfiguration()
    {
        if (empty($this->conf)) {
            $this->conf = $this->loadDefault();
        } else {
            $this->conf = array_merge(self::loadDefault(), $this->conf);
        }

        return $this->conf;
    }

    /**
     * Returns a configuration value.
     *
     * @param string $value
     *
     * @return mixed
     * @throws ConfValueNotFoundException
     */
    public function get($value)
    {
        if (!empty($this->conf)) {
            if (array_key_exists($value, $this->conf)) {

                return $this->conf[$value];
            }
        }

        throw new ConfValueNotFoundException($value);
    }

    /**
     * Initializes the default values.
     *
     * @return array
     */
    private function loadDefault()
    {
        return array(
            'supportedConfExts' => array('xml', 'yml', 'php', 'ini'),
            'locale' => 'en-GB',
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
    public function toArray()
    {
        return $this->conf;
    }
}