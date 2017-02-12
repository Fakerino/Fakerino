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
 * Class ConfNotSupportedException.
 * Configuration file type not supported.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class ConfNotSupportedException extends \RuntimeException
{
    /**
     * Constructor
     *
     * @param string $file
     */
    public function __construct($file)
    {
        parent::__construct(sprintf('The configuration file "%s" is not supported', $file));
    }
}