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
use Fakerino\FakeData\Custom\Integer;

/**
 * Class IntegerGenerator,
 * generates an integer.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class IntegerGenerator extends AbstractFakeDataGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $length = $this->getOption('length');
        $negative = $this->getOption('negative');
        $type = $this->getOption('type');
        $fakeInteger = 0;

        switch($type) {
            case Integer::DECIMAL:
                $fakeInteger = $this->createDecimal($length);
                if ($negative) {
                    $fakeInteger = -1 * $fakeInteger;
                }
                break;
            case Integer::HEX:
                $fakeInteger = $this->createNumber($length, '0123456789abcdef', '0x');
                break;
            case Integer::OCTAL:
                $fakeInteger = $this->createNumber($length, '01234567', '0');
                break;
            case Integer::BINARY:
                $fakeInteger = $this->createNumber($length, '01', '0b');
                break;
        }

        return $fakeInteger;
    }

    private function createDecimal($length)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length)  -1;
        $fakeInteger = rand($min, $max);

        return $fakeInteger;
    }

    private function createNumber($length, $chars, $suffix)
    {
        $stringShuffle = str_shuffle(str_repeat($chars, 10));
        $randomString = substr($stringShuffle, 0, $length);
        $fakeInteger = $suffix . $randomString;

        return $fakeInteger;
    }
}