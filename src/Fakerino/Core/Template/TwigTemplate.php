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

use Twig_Environment;
use Twig_Loader_Array;
use Twig_Loader_Filesystem;
use Twig_Token;

/**
 * Class TwigTemplate
 *
 * @package Fakerino\Template
 */
class TwigTemplate implements TemplateInterface
{
    private $template;
    private $templateName;
    private $loader;
    const TEMPLATE_NAME = 'stringTemplate';

    /**
     * {@inheritdoc}
     */
    public function loadTemplate($template)
    {
        if (!file_exists($template)) {
            $this->templateName = self::TEMPLATE_NAME;
            $this->loader = new Twig_Loader_Array(array(self::TEMPLATE_NAME => $template));
            $this->template = new Twig_Environment($this->loader);
        } else {
            $pathParts = pathinfo($template);
            $this->templateName = $pathParts['filename'] . '.' . $pathParts['extension'];
            $this->loader = new Twig_Loader_Filesystem($pathParts['dirname']);
            $this->template = new Twig_Environment($this->loader);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariables()
    {
        $vars = array();
        $this->templateName;
        $tokens = $this->template->tokenize($this->loader->getSource($this->templateName));
        while ($tokens->isEOF() !== true) {
            $token = $tokens->next();
            if ($token->getType() == Twig_Token::NAME_TYPE) {
                $vars[] = $token->getValue();
            }
        }

        return $vars;
    }

    /**
     * {@inheritdoc}
     */
    public function render($data)
    {
        return $this->template->render($this->templateName, $data);
    }
}