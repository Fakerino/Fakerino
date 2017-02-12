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

use Fakerino\Core\FakeElement;
use Fakerino\Core\FakeHandler\ConfFakerClass;
use Fakerino\Core\FakeHandler\CustomFakerClass;

/**
 * @group handler
 */
class ConfFakerClassTest extends \PHPUnit_Framework_TestCase
{

    public function testHandlerWithNullClass()
    {
        $handler = new ConfFakerClass(null);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertNull($handler->handle(new FakeElement('null')));
    }

    public function testHandlerWithConfiguration()
    {
        $fakeConf = array(
            'fakeTest' => array('Unknown', 'Surname' => null),
        );
        $firstHandler = new CustomFakerClass();
        $handler = new ConfFakerClass($fakeConf);
        $firstHandler->setSuccessor($handler);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $firstHandler);
        $this->assertInternalType('array', $firstHandler->handle(new FakeElement('fakeTest')));
    }
}