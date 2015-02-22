<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData;

/**
 * Interface FakeDataGeneratorInterface
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface FakeDataGeneratorInterface
{
    /**
     * Generates the fake data.
     *
     * @return mixed
     */
    public function generate();
}
