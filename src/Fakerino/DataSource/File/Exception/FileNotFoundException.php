<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\DataSource\File\Exception;

/**
 * Class FileNotFoundException,
 * appears when a file is not found.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileNotFoundException extends \RuntimeException implements FileExceptionInterface
{
    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        parent::__construct(sprintf('The file "%s" does not exist', $filePath));
    }
}