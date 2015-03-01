<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <niklongstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration;

use Fakerino\Configuration\Exception\SourceNotValidException;
use Fakerino\DataSource\File\File;

/**
 * Class AbstractConfigurationFile
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class AbstractConfigurationFile implements ConfigurationInterface
{
    private $confFile;

    /**
     * {@inheritdoc}
     */
    public function loadConfiguration($file)
    {
        if (!$file instanceof File) {
            throw new SourceNotValidException();
        }
        $this->confFile = $file;
    }

    /**
     * Returns file path
     *
     * @return string
     */
    public function getConfFilePath()
    {
        return $this->confFile->getPath();
    }

    /**
     * {@inheritdoc}
     */
    abstract public function toArray();
}
