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
 * Class PhpConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class PhpConfigurationFile extends AbstractConfigurationFile
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        include $this->getConfFilePath();

        return $conf;
    }
}
