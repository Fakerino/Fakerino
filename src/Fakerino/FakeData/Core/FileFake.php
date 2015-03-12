<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData\Core;

use Fakerino\FakeData\FakeDataInterface;

/**
 * Class FileFake
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FileFake implements FakeDataInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * {@inheritdoc}
     */
    public function __construct($filename = null)
    {
        $this->options['filename'] = $filename;
    }
    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function generatedBy()
    {
        return 'Fakerino\\FakeData\\Generator\\FileFakeGenerator';
    }
}
