<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\Exception;

/**
 * Class ConfValueNotPresentException.
 * Configuration value not found.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class ConfValueNotFoundException extends \RuntimeException
{
    /**
     * Constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('
            The configuration value "%s" is not present,
            be sure to load the configuration first, or the value is defined
            ', $value));
    }
}
