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
 * Class FileEmptyException,
 * appears when a file is empty.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileEmptyException extends \RuntimeException implements FileExceptionInterface
{
    /**
     * Constructor
     *
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        parent::__construct(sprintf('The file "%s" is empty', $filePath));
    }
}