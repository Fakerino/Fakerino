<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\ConfigurationFile;

use Fakerino\Configuration\AbstractConfigurationFile;

/**
 * Class XmlConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class XmlConfigurationFile extends AbstractConfigurationFile
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return simplexml_load_file($this->getConfFilePath());
    }
}
