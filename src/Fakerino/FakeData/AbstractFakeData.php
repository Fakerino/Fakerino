<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\FakeData;

use Fakerino\FakeData\Exception\InvalidOptionException;
use Fakerino\FakeData\Exception\MissingRequiredOptionException;

/**
 * Class AbstractFakeData
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
abstract class AbstractFakeData implements FakeDataInterface
{
    /**
     * The default additional generators called if the main one is not available.
     *
     * @var array
     */
    protected $defaultExtraGenerators = array('FromFileGenerator', 'StringGenerator');

    /**
     * @var array
     */
    private $options;

    /**
     * Constructor
     *
     * @param null|array $options
     *
     * @throws MissingRequiredOptionException
     * @throws MissingRequiredOptionException
     * @throws InvalidOptionException
     */
    final public function __construct($options = null)
    {
        if (is_array($this->getDefaultOptions())) {
            $defaultOptions = $templateOptions = array_merge(array('generatedBy' => null), $this->getDefaultOptions());
        } else {
            $defaultOptions = $templateOptions = array('generatedBy' => null);
        }
        $requiredOptions = $this->getRequiredOptions();
        if ($requiredOptions !== null) {
            if ($options === null) {
                throw new MissingRequiredOptionException($requiredOptions[0]);
            }
            $missingRequiredOpt = array_diff($requiredOptions, array_keys($options));
            if (!empty($missingRequiredOpt)) {
                $missingKeys = array_values($missingRequiredOpt);
                throw new MissingRequiredOptionException($missingKeys[0]);
            }
            $templateOptions = array_merge(array_flip($requiredOptions), $defaultOptions);
        }

        if (is_array($options)) {
            $completeOptions = array_merge($defaultOptions, $options);
        } else {
            $completeOptions = $defaultOptions;
        }

        $offset = array_diff_key($completeOptions, $templateOptions);
        if (!empty($offset)) {
            $invalidKeys = array_keys($offset);
            throw new InvalidOptionException($invalidKeys[0]);
        }
        $this->options = $completeOptions;
    }

    /**
     * Gets options.
     *
     * @param string $key
     *
     * @return string|null
     */
    final public function getOption($key)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];

        } else {

            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOptions()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function generatedBy()
    {
        $thisClass = new \ReflectionClass(get_class($this));
        $generatorNameSpace = 'Fakerino\\FakeData\\Generator\\';
        $defaultGenerators = $generatorNameSpace . $thisClass->getShortName() . 'Generator';
        if ($this->options['generatedBy'] !== null) {
            $defaultGenerators = $generatorNameSpace . $this->options['generatedBy'];
        }

        return $defaultGenerators;
    }
}