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

use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\Filler\EntityFiller;
use Fakerino\Core\FakeHandler;
use Fakerino\Test\Fixtures\TestEntity;

class EntityFillerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());

        $this->faker = new FakeDataFactory($fakeHandler);
        $this->entityFiller = new EntityFiller();
    }

    public function testFillProperties()
    {
        $testEntity = new TestEntity();
        $this->entityFiller->fillProperties($testEntity, $this->faker);

        $this->assertNotNull($testEntity->getOne());
        $this->assertNotNull($testEntity->getFour());
        $this->assertNull($testEntity->getTwo());
    }

    public function testFillMethods()
    {
        $testEntity = new TestEntity();
        $this->entityFiller->fillMethods($testEntity, $this->faker);

        $this->assertNotNull($testEntity->getTwo());
        $this->assertNotNull($testEntity->getThree());
        $this->assertNull($testEntity->getOne());
    }

    public function testFill()
    {
        $testEntity = new TestEntity();
        $this->entityFiller->fill($testEntity, $this->faker);

        $this->assertNotNull($testEntity->getOne());
        $this->assertNotNull($testEntity->getFour());
        $this->assertNotNull($testEntity->getOne());
        $this->assertNotNull($testEntity->getFour());
    }
}