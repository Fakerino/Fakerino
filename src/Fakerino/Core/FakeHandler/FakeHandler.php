<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\FakeHandler;

/**
 * Class FakeHandler,
 * it's used like first handlers.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeHandler extends Handler
{
    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        return null;
    }
}