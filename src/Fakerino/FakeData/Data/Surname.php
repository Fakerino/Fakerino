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

use Fakerino\FakeData\AbstractFakeData;

/**
 * Class Surname
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class Surname extends AbstractFakeData
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'length' => rand(5, 30)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
    }
}
