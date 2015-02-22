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

/**
 * Class FakerinoConf,
 * handles the global Fakerino configuration.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakerinoConf implements ConfigurationInterface
{
    /**
     * @var array
     */
    private $conf;

    /**
     * @var array default values
     */
    private $default;

    /**
     * Constructor,
     * Initializes the default values.
     */
    public function __construct()
    {
        $this->default = array(
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
     * {@inheritdoc}
     */
    public function loadConfiguration($conf = null)
    {
        if (is_null($conf)) {
            $this->conf = $this->default;
        } else {
            $this->conf = array_merge($conf, $this->default);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->conf;
    }

    /**
     * Gets a specific configuration value.
     *
     * @param string $value
     *
     * @return string
     */
    public function get($value)
    {
        return $this->conf[$value];
    }

    /**
     * Sets a configuration value.
     *
     * @param string $key
     * @param string $val
     */
    public function set($key, $val)
    {
        $this->conf[$key] = $val;
    }
}

