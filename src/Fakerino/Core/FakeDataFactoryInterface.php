<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core;

/**
 * Class FakeDataFactoryInterface,
 * generates fake data
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
interface FakeDataFactoryInterface
{
    /**
     * Setups the fake element and initializes the output.
     *
     * @param string|array|null $elementName
     *
     * @return FakeDataFactory $this
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fake($elementName = null);

    /**
     * Fills the given entity with fake data.
     *
     * @param object|null $entity
     *
     * @return bool
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fakeEntity($entity = null);

    /**
     * Fills the given table with fake data.
     *
     * @param string|null $tableName
     *
     * @return array $rows
     * @throws \Fakerino\FakeData\Exception\MissingRequiredOptionException
     */
    public function fakeTable($tableName = null);

    /**
     * Fakes a template file.
     *
     * @param string $file
     *
     * @return string
     */
    public function fakeTemplate($file);

    /**
     * Sets $num for iterate the fake process.
     *
     * @param int $num
     *
     * @return FakeDataFactory $this
     * @throws \Exception
     */
    public function num($num = 1);

    /**
     * @param int|null $seed
     *
     * @return FakeDataFactory $this
     */
    public function seed($seed = null);

    /**
     * @return array
     */
    public function toArray();

    /**
     * @return string json
     */
    public function toJson();

    /**
     * @return string
     */
    public function __toString();
}