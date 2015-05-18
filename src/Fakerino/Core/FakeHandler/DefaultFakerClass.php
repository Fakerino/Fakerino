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
 * Class DefaultFakerClass,
 * returns the default basic GenericString class,
 * to provide in any case a fake value.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class DefaultFakerClass extends Handler
{
    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        return $this->getOutput('Fakerino\\FakeData\\Custom\\Text');
    }
}