<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Exception;

/**
 * Class MissingRequiredOptionException,
 * appears when a required option is missing.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class MissingRequiredOptionException extends \RuntimeException
{
    /**
     * Constructor
     *
     * @param string $optionName
     */
    public function __construct($optionName)
    {
        parent::__construct(sprintf('The required option "%s" is missing', $optionName));
    }
}
