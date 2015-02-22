<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Data;

use Fakerino\FakeData\AbstractFakeDataGenerator;

/**
 * Class RandomStringGenerator,
 * generates a random string shuffling the const CHARS.
 * Could receive extra options:
 * length, for setting the string length;
 * addChars for adding more chars to the default chars list.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class RandomStringGenerator extends AbstractFakeDataGenerator
{
    const MINLENGTH = 4;
    const MAXLENGTH = 20;
    const SHUFFLE = 10;
    const CHARS = "0123456789abcdefghijklmnopqrstuvwxyz";

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $chars = self::CHARS;
        $addChars = $this->getOption('addChars');
        if ($addChars !== null) {
            $chars .= $addChars;
        }
        $stringShuffle = str_shuffle(str_repeat($chars, self::SHUFFLE));
        $length = $this->getOption('length');
        if ($length !== null) {
            $randomString = substr($stringShuffle, 0, $length);
        } else {
            $randomString = substr($stringShuffle, 0, rand(self::MINLENGTH, self::MAXLENGTH));
        }

        return $randomString;
    }
}
