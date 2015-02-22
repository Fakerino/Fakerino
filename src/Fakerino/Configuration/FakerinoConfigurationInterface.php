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
 * Interface FakerinoConfigurationInterface
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface FakerinoConfigurationInterface extends ConfigurationInterface
{
    /**
     * @param DataSourceInterface $source
     */
    public function loadConfiguration($source);

    /**
     * @return array
     */
    public function toArray();

    /**
     * Gets a configuration value.
     *
     * @param mixed $value
     */
    public function get($value);

    /**
     * Sets a configuration value.
     *
     * @param string $key
     * @param mixed  $val
     *
     * @return mixed
     */
    public function set($key, $val);
}
