<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Test\Template;

use Fakerino\Core\Template\TwigTemplate;

class TwigTemplateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->templateFile = __DIR__ . '/../../Fixtures/template.html';
        $this->template = new TwigTemplate();
    }

    public function testLoadTemplateString()
    {
        $this->assertTrue($this->template->loadTemplate('Hello {{ nameFemale }}'));
    }

    public function testLoadTemplateFile()
    {
        $this->assertTrue($this->template->loadTemplate($this->templateFile));
    }

    public function testGetVariablesFile()
    {
        $this->template->loadTemplate($this->templateFile);
        $templateVars = $this->template->getVariables();

        $this->assertNotEmpty($templateVars);
    }

    public function testGetVariablesString()
    {
        $this->template->loadTemplate('Hello {{ nameFemale }}');
        $templateVars = $this->template->getVariables();

        $this->assertNotEmpty($templateVars);
    }

    public function testRenderStringTemplate()
    {
        $data = array('nameFemale' => 'TEST');
        $this->template->loadTemplate('Hello {{ nameFemale }}');
        $result = $this->template->render($data);

        $this->assertContains($data['nameFemale'], $result);
    }

    public function testRenderFileTemplate()
    {
        $data = array('surname' => 'TEST');
        $this->template->loadTemplate($this->templateFile);
        $result = $this->template->render($data);

        $this->assertContains($data['surname'], $result);
    }
}