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
 * Class InvalidOptionException,
 * appears when the format of the option is not valid.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class InvalidOptionException extends \RuntimeException
{
    /**
     * Construct
     *
     * @param string $optionName
     */
    public function __construct($optionName)
    {
        parent::__construct(sprintf('The format of the option "%s" is invalid', $optionName));
    }
}