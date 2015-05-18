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

/**
 * Class DateGenerator,
 * generates a random date.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class DateGenerator extends AbstractFakeDataGenerator
{
     /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $format = $this->getOption('format');
        $startDate = $this->getOption('startDate');
        $endDate = $this->getOption('endDate');

        $time = rand(strtotime($startDate), strtotime($endDate));

        return date($format, $time);
    }
}