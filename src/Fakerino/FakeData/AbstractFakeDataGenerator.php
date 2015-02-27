<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData;

/**
 * Class AbstractFakeDataGenerator
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class AbstractFakeDataGenerator implements FakeDataGeneratorInterface
{
    /**
     * @var FakeDataInterface
     */
    protected $caller;

    /**
     * @var mixed
     */
    protected $conf;

    /**
     * Constructor
     *
     * @param FakeDataInterface $fakeData
     * @param null              $conf
     */
    final public function __construct(FakeDataInterface $fakeData, $conf = null)
    {
        $this->caller = $fakeData;
        $this->conf = $conf;
    }

    /**
     * Gets the options useful for the generate process.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getOption($key)
    {
        return $this->caller->getOption($key);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function generate();

}
