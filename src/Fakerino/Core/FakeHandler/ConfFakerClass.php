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
class ConfFakerClass extends Handler
{

    protected function process($data)
    {
        $fakeTag = FakerinoConf::get('fakerinoTag');

        /**
         * When an element in the configuration is not present,
         * FakerinoConf returns an exception.
         * Because the Handler needs a null value to continue the chain handling,
         * the catch block will intercept that exception.
         */
        try {
            $elementInConf = FakerinoConf::get($fakeTag);
            if (array_key_exists($data->getName(), $elementInConf)) {
                $firstChain = self::getFirstChain();
                if ($firstChain !== null) {
                    $classes = array();
                    foreach ($elementInConf[$data->getName()] as $key => $val) {
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