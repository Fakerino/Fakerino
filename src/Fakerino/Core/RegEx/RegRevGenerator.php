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

use Fakerino\Core\RegEx\Exception\InvalidRegexException;
use RegRev\RegRev;

/**
 * Interface RegExGenerator,
 * provides an interface for the RegRev regular expression generator.
 *
 * @package Fakerino\Core\RegEx
 */
class RegRevGenerator implements RegExGeneratorInterface
{
    /**
     * @param string $regex
     *
     * @return string
     * @throws InvalidRegexException
     */
    public function generate($regex)
    {
        $expr = substr($regex, 1, -1);
        $result = RegRev::generate($expr);
        if ($result !== null) {

            return $result;
        } else {
            throw new InvalidRegexException($expr);
        }
    }
}