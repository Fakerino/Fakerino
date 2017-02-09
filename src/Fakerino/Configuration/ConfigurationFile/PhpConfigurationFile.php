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

use Fakerino\Configuration\ConfigurationParserInterface;
use Fakerino\Configuration\Exception\ConfNotSupportedException;
use Fakerino\Configuration\FakerinoConfigurationLoader;

/**
 * Class PhpConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class PhpConfigurationFile extends FakerinoConfigurationLoader implements ConfigurationParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $conf = null;
        $phpConfFile = $this->getConfFilePath();
        require($phpConfFile);
        if ($conf === null) {
            throw new ConfNotSupportedException($phpConfFile);
        }

        return $conf;
    }
}