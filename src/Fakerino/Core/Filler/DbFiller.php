<?php
/**
 * This file is part of the Fakerino package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Core\Filler;

use Fakerino\Core\Database\DbFieldEntity;
use Fakerino\Core\Database\DbInterface;
use Fakerino\Core\Database\DbRowEntity;
use Fakerino\Core\FakeDataFactory;

/**
 * Class DbFiller,
 * provides functionalities for fake a database table.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class DbFiller implements FillerInterface
{
    private $db;

    const NUMERIC = 'integer';
    const STRING = 'string';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const TIME = 'time';

    /** @var FakeDataFactory */
    private $faker;

    /** @var int */
    private $num;

    /**
     * @param DbInterface     $db
     * @param string          $tableName
     * @param FakeDataFactory $faker
     * @param int             $num
     */
    public function __construct(DbInterface $db, $tableName, FakeDataFactory $faker, $num = 1)
    {
        $this->db = $db;
        $this->faker = $faker;
        $db->connect();
        $db->setTable($tableName);
        $this->num = $num;
    }

    /**
     * Fills the tablename with fake value.
     *
     * @return array
     */
    public function fill()
    {
        $totalColumn = $this->db->getTotalColumns();
        $rows = array();
        for ($n = 0; $n < $this->num; $n++) {
            $fakeRow = new DbRowEntity();
            for ($i = 0; $i < $totalColumn; $i ++) {
                if ($this->db->isColumnAutoincrement($i)) {
                    continue;
                }
                $fieldName = $this->db->getColumnName($i);
                $fakeType = $this->db->getColumnType($i);
                $dataLength = $this->db->getColumnLength($i);
                $fakeData = $this->fakeColumn($fieldName, $fakeType, $dataLength);

                $fakeRow->setFields(new DbFieldEntity($fieldName, $fakeData[0], $fakeType, $dataLength));
            }
            $this->db->insert($fakeRow);

            $rows[] = $fakeRow->toArray();
        }

        return $rows;
    }

    private function fakeColumn($fakeName, $fakeType, $maxLength)
    {
        switch ($fakeType) {
            case self::NUMERIC:
                $result = $this->faker->fake(array('Integer' => array('length' => mt_rand(6, 8))))->num(1);
                break;
            case self::DATE:
                $result = $this->faker->fake(array('date'))->num(1);
                $maxLength = $maxLength === null ? 10 : $maxLength;
                break;
            case self::DATETIME:
                $result = $this->faker->fake(array('date' => array('format' => 'Y-m-d H:i:s')))->num(1);
                $maxLength = $maxLength === null ? 19 : $maxLength;
                break;
            case self::TIME:
                $result = $this->faker->fake(array('date' => array('format' => 'H:i:s')))->num(1);
                $maxLength = $maxLength === null ? 8 : $maxLength;
                break;
            default:
                $result = $this->faker->fake($fakeName)->num(1);
                break;
        }
        $result = substr($result, 0, $maxLength);

        return array($result);
    }
}
