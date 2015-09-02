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

/**
 * Class IniConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class IniConfigurationFile extends AbstractConfigurationFile
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return  parse_ini_file($this->getConfFilePath(), true);
    }
}