<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Configuration\Exception;

/**
 * Class SourceNotValidException,
 * appears when the specified configuration is not valid.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class SourceNotValidException extends \RuntimeException
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('The source specified is not valid');
    }
}
