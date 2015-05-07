<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Core;

use Fakerino\FakeData\AbstractFakeData;

/**
 * Class GenericString,
 * is a generic fake string.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class GenericString extends AbstractFakeData
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'length' => rand(3, 20)
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
        return 'Fakerino\\FakeData\\Generator\\RandomStringGenerator';
    }
}