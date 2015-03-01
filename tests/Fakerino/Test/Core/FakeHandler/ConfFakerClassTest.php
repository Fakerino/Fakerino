<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Test\Core\FakeHandler;

use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\FakeHandler\ConfFakerClass;
use Fakerino\Core\FakeHandler\CustomFakerClass;

class ConfFakerClassTest extends \PHPUnit_Framework_TestCase
{

    public function testHandlerWithNullClass()
    {
        $handler = new ConfFakerClass();
        FakerinoConf::loadConfiguration();

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertNull($handler->handle('null'));
    }

    public function testHandlerWithConfiguration()
    {
        $fakeConf['fake'] = array(
            'fakeTest' => array('Unknown', 'Surname' => null)
        );
        FakerinoConf::loadConfiguration($fakeConf);
        $firstHandler = new CustomFakerClass();
        $handler = new ConfFakerClass();
        $firstHandler->setSuccessor($handler);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $firstHandler);
        $this->assertInternalType('array', $firstHandler->handle('fakeTest'));
    }
}
