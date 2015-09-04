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
 * Class RegExGenerator,
 * generates an integer.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class RegExGenerator extends AbstractFakeDataGenerator
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $regexGenerator = $this->getOption('regexgenerator');
        $expr = $this->getOption('expression');

        return $regexGenerator->generate($expr);
    }
}