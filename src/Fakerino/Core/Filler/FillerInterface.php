<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Filler;

/**
 * FillerInterface,
 * describes the interface for the fillers.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface FillerInterface
{
    /**
     * @return mixed
     */
    public function fill();
}