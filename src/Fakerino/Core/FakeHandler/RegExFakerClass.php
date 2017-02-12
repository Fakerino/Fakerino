<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\FakeHandler;

use Fakerino\Core\RegEx\RegExGeneratorInterface;

/**
 * Class RegExFakerClass,
 * processes the request of a regular expression.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class RegExFakerClass extends Handler
{
    private $regexGenerator;

    /**
     * Constructor.
     *
     * @param RegExGeneratorInterface $regexGenerator
     */
    public function __construct(RegExGeneratorInterface $regexGenerator)
    {
        $this->regexGenerator = $regexGenerator;
    }

    /**
     * {@inheritdoc}
     */
    protected function process($data)
    {
        $elementName = $data->getName();
        $options = $data->getOptions();
        $expr = null;
        if ($elementName[0] == '/') {
            $expr = $elementName;
        }
        if ($options !== null && is_string($options)) {
            if ($options[0] == '/') {
                $expr = $options;
            }
        }
        if ($expr !== null) {
            $options = array(
                'regexgenerator' => $this->regexGenerator,
                'expression' => $expr,
            );

            return $this->getOutput('Fakerino\\FakeData\\Core\\RegExFake', $options);
        }

        return;
    }
}