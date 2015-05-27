<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\RegEx\Exception;

/**
 * Class InvalidRegexException,
 * appears when the format of the regular expression is not valid.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class InvalidRegexException extends \RuntimeException
{
    /**
     * Construct
     *
     * @param string $expr
     */
    public function __construct($expr)
    {
        parent::__construct(sprintf('The format of the regular expression "%s" is invalid', $expr));
    }
}