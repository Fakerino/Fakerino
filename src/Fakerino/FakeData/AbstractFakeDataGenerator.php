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
     * Sets the class that calls this generator.
     *
     * @param FakeDataInterface $fakeData
     */
    public function setCaller(FakeDataInterface $fakeData)
    {
        $this->caller = $fakeData;
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