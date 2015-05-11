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
     * Sets a successor handler,
     * in case the class is not able to satisfy the request.
     *
     * @param HandlerInterface $handler
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
     * Handles the request or redirect the request
     * to the successor.
     *
     * @param string|array $data
     *
     * @return string
     */
    final public function handle($data)
    {
        $processed = $this->process($data);
        if ($processed === null) {
            if ($this->successor !== null) {
                $processed = $this->successor->handle($data);
            }
        }

        return $processed;
    }

    /**
     * Generates the output.
     *
     * @param string            $class
     * @param string|array|null $options
     *
     * @return string|array
     */
    public function getOuput($class, $options = null)
    {
        return OutPutFactory::getOuput($class, $options);
    }

    /**
     * Returns the first Handler in the chain.
     *
     * @return Handler
     */
    public static function getFirstChain()
    {
        return self::$first;
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
     * @param string|array $data
     *
     * @return mixed
     */
    abstract protected function process($data);
}