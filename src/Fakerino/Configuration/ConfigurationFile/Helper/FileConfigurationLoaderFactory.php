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
use Fakerino\DataSource\File\Exception\FileNotFoundException;
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
     * @throws FileNotFoundException
     */
    public function load()
    {
        if (is_dir($this->filePath) &&
            !$this->filePath = $this->getFilePath()) {

                throw new FileNotFoundException($this->filePath);
        }

        return $this->getConfigFile();
    }

    /**
     * Returns config file class according to the file's extension
     *
     * @return Fakerino\Configuration\ConfigurationInterface
     * @throws ConfNotSupportedException
     */
    private function getConfigFile()
    {
        $file = new File($this->filePath);
        $fileExt = $file->getExtension();
        $fileConfClass = $this->getConfigFileClass($fileExt);
        if (class_exists($fileConfClass)) {
            $fileConf = new $fileConfClass();
            $fileConf->loadConfiguration($file);

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

    /**
     * Returns the filepath
     *
     * @return null|string
     */
    private function getFilePath()
    {
        $pathInfo = pathinfo($this->filePath);
        $dirName = $pathInfo['dirname'];
        $fileName = $pathInfo['filename'];
        foreach ($this->exts as $val) {
            $file = $dirName . DIRECTORY_SEPARATOR . $fileName . '.' . $val;
            if (file_exists($file)) {

                return $file;
            }
        }

        return;
    }
}