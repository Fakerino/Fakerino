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
use Fakerino\Core\FakeHandler\RegExFakerClass;
use Fakerino\Core\RegEx\RegRevGenerator;

/**
 * @group handler
 */
class RegExFakerClassTest extends \PHPUnit_Framework_TestCase
{
    public function testHandler()
    {
        $length = 3;
        $handler = new RegExFakerClass(new RegRevGenerator());
        $customClass = new FakeElement('/\d{' . $length . '}/');
        $result = $handler->handle($customClass);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertEquals($length, strlen($result));
    }

    public function testHandlerOptions()
    {
        $length = 3;
        $handler = new RegExFakerClass(new RegRevGenerator());
        $customClass = new FakeElement('number', '/\d{' . $length . '}/');
        $result = $handler->handle($customClass);

        $this->assertInstanceOf('Fakerino\Core\FakeHandler\Handler', $handler);
        $this->assertEquals($length, strlen($result));
    }
}