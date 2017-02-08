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
use Fakerino\Core\FakeHandler\CustomFakerClass;

/**
 * @group handler
 */
class CustomFakerClassTest extends \PHPUnit_Framework_TestCase
{
    public function testHandlerCreation()
    {
        $handler = new CustomFakerClass();
        $data = new FakeElement('text');

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);

        $this->assertInternalType('string', $handler->handle($data));
    }

    public function testHandlerWithOptions()
    {
        $length = 1;
        $handler = new CustomFakerClass();
        $data = new FakeElement('Integer', array('length' => $length));
        $result = $handler->handle($data);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertInternalType('int', $result);
        $this->assertEquals($length, strlen($result));

    }
}