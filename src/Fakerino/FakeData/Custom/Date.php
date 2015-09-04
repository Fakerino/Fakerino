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
 * Class Date,
 * fakes a date.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class Date extends AbstractFakeData
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
            'format' => 'Y-m-d',
            'startDate' => '1970-01-01',
            'endDate' => date('Y-m-d')
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
        return 'Fakerino\\FakeData\\Generator\\DateGenerator';
    }
}