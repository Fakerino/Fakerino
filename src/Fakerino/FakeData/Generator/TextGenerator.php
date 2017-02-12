<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Generator;

use Fakerino\FakeData\AbstractFakeDataGenerator;

/**
 * Class TextGenerator,
 * generates a random string shuffling the const CHARS.
 * Could receive extra options:
 * length, for setting the string length;
 * addChars for adding more chars to the default chars list.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class TextGenerator extends AbstractFakeDataGenerator
{
    const MIN_LENGTH = 4;
    const MAX_LENGTH = 20;
    const SHUFFLE = 10;
    const CHARS = "0123456789abcdefghijklmnopqrstuvwxyz";

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $chars = self::CHARS;
        $addChars = $this->getOption('addChar');
        if ($addChars !== null) {
            $chars .= $addChars;
        }
        $length = $this->getOption('length');
        if ($length !== null) {
            if ($length > strlen($chars)) {
                $origChars = $chars;
                while (strlen($chars) < $length) {
                    $chars .= $origChars;
                }
            }
        } else {
            $length = mt_rand(self::MIN_LENGTH, self::MAX_LENGTH);
        }
        $stringShuffle = $this->stringShuffle($chars);
        $randomString = substr($stringShuffle, 0, $length);

        return $randomString;
    }

    private function stringShuffle($chars)
    {
        $shuffledString = '';
        $charsLength = strlen($chars);
        for ($i = 0; $i < $charsLength; $i++) {
            $rand = mt_rand(0, $charsLength - 1);
            $shuffledString .= substr($chars, $rand, 1);
        }

        return $shuffledString;
    }
}