<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\DataSource\File;

use Fakerino\DataSource\File\Exception\FileEmptyException;
use Fakerino\DataSource\File\Exception\FileLineNotFoundException;
use Fakerino\DataSource\File\Exception\FileNotFoundException;

/**
 * Class File
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class File extends \SplFileInfo
{
    /**
     * Constructor
     *
     * @param string $path
     *
     * @throws FileNotFoundException
     */
    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException($path);
        }

        parent::__construct($path);
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return basename($this->getRealPath());
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        return finfo_file($finfo, $this->getRealPath());
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return pathinfo($this->getBasename(), PATHINFO_EXTENSION);
    }

    /**
     * @return string
     * @throws Exception\FileEmptyException
     */
    public function getContent()
    {
        if ($content = file_get_contents($this->getRealPath())) {

            return $content;
        } else {
            throw new FileEmptyException($this->getRealPath());
        }
    }

    /**
     * @param integer $lineNumber
     *
     * @return string
     * @throws Exception\FileLineNotFoundException
     */
    public function readLine($lineNumber)
    {
        $content = $this->getContent();
        if (count($content) > $lineNumber) {

            return $content[$lineNumber];
        } else {
            throw new FileLineNotFoundException($this->getRealPath(), $lineNumber);
        }
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->getRealPath();
    }
}