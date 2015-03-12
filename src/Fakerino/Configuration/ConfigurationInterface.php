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
 * Interface ConfigurationInterface
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface ConfigurationInterface
{
    /**
     * @param array $source
     */
    public function loadConfiguration($source);

    /**
     * @return array
     */
    public function toArray();
}
