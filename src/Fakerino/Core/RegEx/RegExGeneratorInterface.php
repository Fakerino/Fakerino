<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\RegEx;

/**
 * Interface RegExInterface,
 * provides an interface for a regular expression generator.
 *
 * @package Fakerino\Core\RegEx
 */
interface RegExGeneratorInterface
{
    /**
     * Generates a string from the provided $regex
     *
     * @param string $regex
     *
     * @return string
     */
    public function generate($regex);
}