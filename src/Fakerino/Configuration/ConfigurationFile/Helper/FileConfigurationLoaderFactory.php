<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\ConfigurationFile\Helper;

use Fakerino\Configuration\Exception\ConfNotSupportedException;
use Fakerino\DataSource\File\File;

/**
 * Class FileConfigurationLoaderFactory
 * loads the configuration file
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class FileConfigurationLoaderFactory
{
    private $filePath;
    private $exts = array();

    /**
     * Constructor
     *
     * @param string $filePath
     * @param array  $exts
     */
    public function __construct($filePath, $exts)
    {
        $this->filePath = $filePath;
        $this->exts = $exts;
    }

    /**
     * Finds and returns the file if exists
     *
     * @return Fakerino\Configuration\ConfigurationInterface
     * @throws ConfNotSupportedException
     */
    public function load()
    {
        $file = new File($this->filePath);
        $fileExt = $file->getExtension();
        $fileConfClass = $this->getConfigFileClass($fileExt);
        if (class_exists($fileConfClass)) {
            $fileConf = new $fileConfClass($file);

            return $fileConf;
        }

        throw new ConfNotSupportedException($this->filePath);
    }

    /**
     * Returns the conf file class name
     *
     * @param string $fileExt
     *
     * @return string
     */
    private function getConfigFileClass($fileExt)
    {
        return 'Fakerino\\Configuration\\ConfigurationFile\\'
        . ucfirst($fileExt)
        . 'ConfigurationFile';
    }
}