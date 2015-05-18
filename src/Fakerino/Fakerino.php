<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino;

use Fakerino\Configuration\ConfigurationFile\Helper\FileConfigurationLoaderFactory;
use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\Database\DoctrineLayer;
use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\FakeHandler;

/**
 * Class Fakerino,
 * initializes the system.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class Fakerino
{
    /**
     * Bootstrap function for Fakerino,
     * setups the global configuration.
     *
     * @param null|array|string $conf
     *
     * @return FakeDataFactory
     */
    public static function create($conf = null)
    {
        FakerinoConf::loadConfiguration();
        if ($conf !== null) {
            $confArray = $conf;
            if (!is_array($conf)) {
                $confTypeFactory = new FileConfigurationLoaderFactory(
                    $conf,
                    FakerinoConf::get('supportedConfExts')
                );
                $confParser = $confTypeFactory->load();
                $confArray = $confParser->toArray();
            }
            FakerinoConf::loadConfiguration($confArray);
        }

        return new FakeDataFactory(self::getDefaultHandler(), new DoctrineLayer());
    }

    /**
     * Get the global configuration.
     *
     * @return array
     */
    public static function getConfig()
    {
        return FakerinoConf::toArray();
    }

    private static function getDefaultHandler()
    {
        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\FileFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\ConfFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());

        return $fakeHandler;
    }
}