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
 * Class Text,
 * fakes a string.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class Text extends AbstractFakeData
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array(
            'length' => mt_rand(3, 20),
            'addChar' => null,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
    }
}