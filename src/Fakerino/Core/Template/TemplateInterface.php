<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Template;

/**
 * Interface TemplateInterface,
 * defines an interface for fake a template file.
 *
 * @package Fakerino\Core\Template
 */
interface TemplateInterface
{
    /**
     * @param string $template
     *
     * @return bool
     */
    public function loadTemplate($template);

    /**
     * @return array
     */
    public function getVariables();

    /**
     * @param array $data
     *
     * @return string
     */
    public function render($data);
}