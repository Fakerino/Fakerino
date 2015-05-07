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
use Fakerino\Configuration\Exception\ConfNotSupportedException;

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
        $conf = null;
        $phpConfFile = $this->getConfFilePath();
        require_once($phpConfFile);
        if ($conf === null) {
            throw new ConfNotSupportedException($phpConfFile);
        }

        return $conf;
    }
}