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
use Symfony\Component\Yaml\Parser as YamlParser;

/**
 * Class YamlConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class YamlConfigurationFile extends FakerinoConfigurationLoader implements ConfigurationParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $yaml = new YamlParser();

        $array = $yaml->parse(file_get_contents($this->getConfFilePath(), true));
        if (empty($array)) {

            return array();
        }
        if (!is_array($array)) {

            return array($array);
        }

        return $array;
    }
}