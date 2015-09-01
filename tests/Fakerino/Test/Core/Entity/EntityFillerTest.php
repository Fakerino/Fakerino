<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\Entity;

use Fakerino\Core\Entity\EntityInfo;
use Fakerino\Test\Fixtures\TestEntity;

class EntityFillerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $testEntity = new TestEntity();
        $this->entityFiller = new EntityInfo($testEntity);
    }

    public function testGetProperties()
    {
        $properties = $this->entityFiller->getProperties();

        $this->assertNotEmpty($properties);
        $this->assertInternalType('array', $properties);
        $this->assertEquals(2, count($properties));
    }

    public function testGetMethods()
    {
        $methods = $this->entityFiller->getMethods();

        $this->assertNotEmpty($methods);
        $this->assertInternalType('array', $methods);
        $this->assertEquals(12, count($methods));
    }

    public function testGetSetters()
    {
        $setters = $this->entityFiller->getSetters();

        $this->assertNotEmpty($setters);
        $this->assertInternalType('array', $setters);
        $this->assertEquals(6, count($setters));
    }

    public function testWrongObjectProvidedtoEntityConstructor()
    {
        $this->setExpectedException('\RuntimeException');

        $badEntityFiller = new EntityInfo('foo');
    }
}