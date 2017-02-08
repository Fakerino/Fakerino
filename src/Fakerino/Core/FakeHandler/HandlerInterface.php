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

/**
 * Class HandlerInterface,
 * interface for fake data request handler.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface HandlerInterface
{
    /**
     * Returns the first Handler in the chain.
     *
     * @return Handler
     */
    static function getFirstChain();

    /**
     * Resets the first Handler in the chain.
     *
     * @return Handler
     */
    static function resetFirstChain();

    /**
     * Sets a successor handler,
     * in case the class is not able to satisfy the request.
     *
     * @param HandlerInterface $handler
     */
    function setSuccessor(HandlerInterface $handler);

    /**
     * Handles the request or redirect the request
     * to the successor.
     *
     * @param FakeElement $data
     *
     * @return mixed
     */
    function handle(FakeElement $data);

    /**
     * Generates the output.
     *
     * @param string            $class
     * @param string|array|null $options
     *
     * @return string|array
     */
    function getOutput($class, $options = null);
}