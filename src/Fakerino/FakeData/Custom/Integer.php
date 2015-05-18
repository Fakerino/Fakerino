<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Custom;

use Fakerino\FakeData\AbstractFakeData;

/**
 * Class Integer,
 * fakes an integer.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class Integer extends AbstractFakeData
{
    const DECIMAL = 'decimal';
    const HEX = 'hex';
    const OCTAL = 'octal';
    const BINARY = 'binary';

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'length' => rand(1, 5),
            'negative' => false,
            'type' => self::DECIMAL
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function generatedBy()
    {
        return 'Fakerino\\FakeData\\Generator\\IntegerGenerator';
    }
}