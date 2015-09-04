<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Test\Filler;

use Fakerino\Core\Database\DoctrineLayer;
use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\FakeHandler;
use Fakerino\Core\Filler\EntityFiller;
use Fakerino\Core\Template\TwigTemplate;
use Fakerino\Test\Fixtures\TestEntity;

class EntityFillerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());

        $this->faker = new FakeDataFactory($fakeHandler, new DoctrineLayer(null), new TwigTemplate());
    }

    public function testFillProperties()
    {
        $this->setUpFiller();
        $this->entityFiller->fillProperties();

        $this->assertNotNull($this->testEntity->getOne());
        $this->assertNotNull($this->testEntity->getFour());
        $this->assertNull($this->testEntity->getTwo());
    }

    public function testFillMethods()
    {
        $this->setUpFiller();
        $this->entityFiller->fillMethods();

        $this->assertNotNull($this->testEntity->getTwo());
        $this->assertNotNull($this->testEntity->getThree());
        $this->assertNull($this->testEntity->getOne());
    }

    public function testFill()
    {
        $this->setUpFiller();
        $this->entityFiller->fill();

        $this->assertNotNull($this->testEntity->getOne());
        $this->assertNotNull($this->testEntity->getFour());
        $this->assertNotNull($this->testEntity->getOne());
        $this->assertNotNull($this->testEntity->getFour());
    }

    private function setUpFiller()
    {
        $this->testEntity = new TestEntity();
        $this->entityFiller = new EntityFiller($this->testEntity, $this->faker);
    }
}