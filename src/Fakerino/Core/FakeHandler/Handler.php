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

use Fakerino\Core\FakeElement;
use Fakerino\Core\OutPutFactory;

/**
 * Class Handler,
 * handles the fake data request.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class Handler implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    private $successor = null;

    /**
     * @var Handler
     */
    private static $first = null;

    /**
     * @var array
     */
    private static $outputContainer = array();

    /**
     * @var string
     */
    private static $fakeElement;

    /**
     * {@inheritdoc}
     */
    final public function setSuccessor(HandlerInterface $handler)
    {
        $this->setFirstChain();
        if ($this->successor === null) {
            $this->successor = $handler;
        } else {
            $this->successor->setSuccessor($handler);
        }
    }

    /**
     * {@inheritdoc}
     */
    final public function handle(FakeElement $data)
    {
        self::$fakeElement = $data->getName() . serialize($data->getOptions());
        if (array_key_exists(self::$fakeElement, self::$outputContainer)) {

            return $this->getOutput(
                self::$outputContainer[self::$fakeElement][0],
                self::$outputContainer[self::$fakeElement][1]
            );
        }
        $processed = $this->process($data);
        if ($processed === null) {
            if ($this->successor !== null) {
                $processed = $this->successor->handle($data);
            }
        }

        return $processed;
    }

    /**
     * {@inheritdoc}
     */
    public function getOutput($class, $options = null)
    {
        if (!array_key_exists(self::$fakeElement, self::$outputContainer)) {
            self::$outputContainer[self::$fakeElement] = array($class, $options);
        }

        return OutPutFactory::getOutput($class, $options);
    }

    /**
     * {@inheritdoc}
     */
    public static function getFirstChain()
    {
        return self::$first;
    }

    /**
     * {@inheritdoc}
     */
    public static function resetFirstChain()
    {
        self::$first = null;
    }

    private function setFirstChain()
    {
        if (self::$first === null) {
            self::$first = $this;
        }
    }

    /**
     * Processes the request.
     *
     * @param FakeElement $data
     *
     * @return mixed
     */
    abstract protected function process($data);
}