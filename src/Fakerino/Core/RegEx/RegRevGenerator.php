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
final class RegRevGenerator implements RegExGeneratorInterface
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
        try {
            $result = RegRev::generate($expr);
        } catch (\Exception $e) {
            throw new InvalidRegexException($expr);
        }

        return $result;
    }
}