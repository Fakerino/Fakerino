<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <niklongstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\ConfigurationFile;

use Fakerino\Configuration\ConfigurationParserInterface;
use Fakerino\Configuration\FakerinoConfigurationLoader;

/**
 * Class IniConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class IniConfigurationFile extends FakerinoConfigurationLoader implements ConfigurationParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = parse_ini_file($this->getConfFilePath(), true);
        if (empty($array)) {

            return array();
        }

        return $array;
    }
}