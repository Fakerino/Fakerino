<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core;

/**
 * Class OutPutFactory,
 * Handles the output generation,
 * combines FakeDataClass with Generators.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class OutPutFactory
{
    /**
     * Returns a string output.
     *
     * @param string            $class
     * @param string|array|null $options
     *
     * @return string|array
     */
    public static function getOutput($class, $options = null)
    {
        $fakeClass = new $class($options);
        $generatorName = $fakeClass->generatedBy();
        $generator = new $generatorName();
        $generator->setCaller($fakeClass);

        return $generator->generate();
    }
}