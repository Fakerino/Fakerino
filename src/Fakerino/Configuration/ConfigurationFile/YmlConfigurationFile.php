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

use Fakerino\Configuration\AbstractConfigurationFile;
use Symfony\Component\Yaml\Parser;

/**
 * Class YamlConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class YmlConfigurationFile extends AbstractConfigurationFile
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $yaml = new Parser();

        return $yaml->parse(file_get_contents($this->getConfFilePath(), true));
    }
}