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

use Fakerino\DataSource\File\File;

/**
 * Class FakerinoConfigurationLoader
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakerinoConfigurationLoader
{
    /* @var File */
    private $confFile;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
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
}