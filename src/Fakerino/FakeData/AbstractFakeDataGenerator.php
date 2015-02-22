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

use Fakerino\Configuration\ConfigurationInterface;

/**
 * Class AbstractFakeDataGenerator
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class AbstractFakeDataGenerator implements FakeDataGeneratorInterface
{
    /**
     * @var array
     */
    protected $options;

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
     */
    public function __construct(FakeDataInterface $fakeData)
    {
        $this->caller = $fakeData;
        $this->options = $fakeData->getOptions();
    }

    /**
     * {@inheritdoc}
     */
    abstract public function generate();

    /**
     * Sets additional paramenters like global configurations.
     *
     * @param ConfigurationInterface $conf
     */
    public function setConf(ConfigurationInterface $conf)
    {
        $this->conf = $conf;
    }
}
