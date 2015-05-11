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
         * FakerinoConf will return an exception,
         * but the handler needs a null value to continue the chain handling,
         * so the catch will intercept that exception.
         */
        try {
            $elementInConf = FakerinoConf::get($fakeTag);
            if (array_key_exists($data, $elementInConf)) {
                $firstChain = self::getFirstChain();
                if ($firstChain !== null) {
                    $classes = array();
                    foreach ($elementInConf[$data] as $key => $val) {
                        $element = $this->findElementFrom($key, $val);
                        $classes[] = $firstChain->handle($element);
                    }

                    return $classes;
                }
            }
        } catch (ConfValueNotFoundException $e) {
        }

        return null;
    }

    /**
     * Finds an element from key or val.
     *
     * @param string $key
     * @param string $val
     *
     * @return mixed
     */
    private function findElementFrom($key, $val)
    {
        if (is_numeric($key)) {

            return $val;
        }

        return $key;
    }
}