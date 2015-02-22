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
 * Class FileLineNotFoundException,
 * appears when a line in a file is not found.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileLineNotFoundException extends \RuntimeException implements FileExceptionInterface
{
    /**
     * Constructor
     *
     * @param string    $lineNumber
     * @param int       $filePath
     */
    public function __construct($lineNumber, $filePath)
    {
        parent::__construct(sprintf('The line "%d" does not exist in file "%s"', $lineNumber, $filePath));
    }
}
