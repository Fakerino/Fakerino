<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Core;

use Fakerino\FakeData\FakeDataInterface;

/**
 * Class RegExFake
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class RegExFake implements FakeDataInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * {@inheritdoc}
     */
    public function __construct($option = null)
    {
        $this->options['regexgenerator'] = $option['regexgenerator'];
        $this->options['expression'] = $option['expression'];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function generatedBy()
    {
        return 'Fakerino\\FakeData\\Generator\\RegExGenerator';
    }
}