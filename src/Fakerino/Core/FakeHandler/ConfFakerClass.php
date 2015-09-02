<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\FakeHandler;

use Fakerino\Configuration\Exception\ConfValueNotFoundException;
use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\FakeElement;

/**
 * Class ConfFakerClass,
 * processes the request of complex fake element
 * defined in the configuration.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class ConfFakerClass extends Handler
{
    private $fakeElements;

    /**
     * @param array|string $fakeElements
     */
    public function __construct($fakeElements)
    {
        $this->fakeElements = $fakeElements;
        if (!is_array($fakeElements)) {
            $this->fakeElements = array($fakeElements);
        }
    }

    protected function process($data)
    {
        /**
         * When an element in the configuration is not present,
         * FakerinoConf returns an exception.
         * Because the Handler needs a null value to continue the chain handling,
         * the catch block will intercept that exception.
         */
        try {
            if (array_key_exists($data->getName(), $this->fakeElements)) {
                $firstChain = self::getFirstChain();
                if ($firstChain !== null) {
                    $classes = array();

                    foreach ($this->fakeElements[$data->getName()] as $key => $val) {
                        $element = new FakeElement($key, $val);
                        $classes[] = $firstChain->handle($element);
                    }

                    return $classes;
                }
            }
        } catch (ConfValueNotFoundException $e) {
        }

        return;
    }
}