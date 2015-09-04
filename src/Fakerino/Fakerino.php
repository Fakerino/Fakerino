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
use Fakerino\Configuration\Exception\ConfValueNotFoundException;
use Fakerino\Configuration\FakerinoConf;
use Fakerino\Core\Database\DoctrineLayer;
use Fakerino\Core\FakeDataFactory;
use Fakerino\Core\FakeHandler;
use Fakerino\Core\RegEx\RegRevGenerator;
use Fakerino\Core\Template\TwigTemplate;

/**
 * Class Fakerino,
 * initializes the system.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class Fakerino
{
    private static $defaultConf;

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
        self::$defaultConf = new FakerinoConf();
        self::$defaultConf->loadConfiguration();
        $databaseConfig = null;
        if ($conf !== null) {
            $confArray = $conf;
            if (!is_array($conf)) {
                $confTypeFactory = new FileConfigurationLoaderFactory(
                    $conf,
                    self::$defaultConf->get('supportedConfExts')
                );
                $confParser = $confTypeFactory->load();
                $confArray = $confParser->toArray();
            }
            $conf = $confArray;
        }
        self::$defaultConf = new FakerinoConf($conf);
        self::$defaultConf->loadConfiguration();

        return new FakeDataFactory(self::getDefaultHandler(), new DoctrineLayer(self::getDatabaseConfig()), new TwigTemplate());
    }

    /**
     * Get the global configuration.
     *
     * @return array
     */
    public static function getConfig()
    {
        return self::$defaultConf->toArray();
    }

    private static function getDefaultHandler()
    {
        $filePath = self::getDefaultFakefilePath();
        $fakerinoTag = self::getDefaultFakerinoTag();

        $fakeHandler = new FakeHandler\FakeHandler();
        $fakeHandler->setSuccessor(new FakeHandler\FileFakerClass($filePath));
        $fakeHandler->setSuccessor(new FakeHandler\CustomFakerClass());
        $fakeHandler->setSuccessor(new FakeHandler\ConfFakerClass($fakerinoTag));
        $fakeHandler->setSuccessor(new FakeHandler\RegExFakerClass(new RegRevGenerator()));
        $fakeHandler->setSuccessor(new FakeHandler\DefaultFakerClass());

        return $fakeHandler;
    }

    private static function getDefaultFakefilePath()
    {
        return self::$defaultConf->get('fakeFilePath')
        . DIRECTORY_SEPARATOR
        . self::$defaultConf->get('locale')
        . DIRECTORY_SEPARATOR;
    }

    private static function getDefaultFakerinoTag()
    {
        self::$defaultConf->get('fakerinoTag');
        try {
            $conf = self::$defaultConf->get('fake');
        } catch (ConfValueNotFoundException $e) {
            $conf = null;
        }

        return $conf;
    }

    private static function getDatabaseConfig()
    {
        try {
            $conf = self::$defaultConf->get('database');
        } catch (ConfValueNotFoundException $e) {
            $conf = null;
        }

        return $conf;
    }
}