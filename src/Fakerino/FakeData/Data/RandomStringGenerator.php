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
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class RandomStringGenerator extends AbstractFakeDataGenerator
{
    const MINLENGTH = 4;
    const MAXLENGTH = 20;
    const CHARS = "0123456789abcdefghijklmnopqrstuvwxyz";

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $stringShuffle = str_shuffle(str_repeat(self::CHARS, 10));
        if (isset($this->length)) {
            $randomString = substr($stringShuffle, 0, $this->length);
        } else {
            $randomString = substr($stringShuffle, 0, rand(self::MINLENGTH, self::MAXLENGTH));
        }

        return $randomString;
    }
}
