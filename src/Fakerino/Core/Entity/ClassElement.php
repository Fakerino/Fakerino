<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Entity;

/**
 * Class ClassElement,
 * defines a generic class element.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class ClassElement
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isStatic;

    /**
     * @param string $name
     * @param bool   $isStatic
     */
    public function __construct($name, $isStatic = false)
    {
        $this->name = $name;
        $this->isStatic = $isStatic;
    }

    /**
     * Gets element's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns if the element is static.
     *
     * @return bool
     */
    public function isStatic()
    {
        return $this->isStatic;
    }
}