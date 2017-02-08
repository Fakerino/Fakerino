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
 * Interface FakeDataInterface
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface FakeDataInterface
{
    /**
     * Constructor
     *
     * @param null|array $options
     */
    public function __construct($options = null);

    /**
     * Gets the default options.
     *
     * @return array
     */
    public function getDefaultOptions();

    /**
     * Gets the required options.
     *
     * @return array
     */
    public function getRequiredOptions();

    /**
     * Returns generators for processing the fake data.
     *
     * @return string
     */
    public function generatedBy();

    /**
     * Gets an option from its name.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getOption($key);
}