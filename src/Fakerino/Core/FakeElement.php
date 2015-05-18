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
 * Class FakeElement,
 * describes a single fake element.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakeElement
{
    /** @var string */
    private $name;

    /** @var array|null */
    private $options;

    /**
     * Constructor.
     *
     * @param mixed $name
     * @param mixed $options
     */
    public function __construct($name, $options = null)
    {
        if (is_numeric($name)) {
            $this->name = $options;
        } else {
            $this->name = $name;
            $this->options = $options;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array|null
     */
    public function getOptions()
    {
        return $this->options;
    }
}