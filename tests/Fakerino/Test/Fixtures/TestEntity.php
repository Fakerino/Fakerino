<?php
/**
 * Created by PhpStorm.
 * User: deus
 * Date: 25/02/15
 * Time: 23.20
 */

namespace Fakerino\Test\Fixtures;


class TestEntity
{
    public $one;
    private $two;
    protected $three;
    static public $four;
    static private $five;
    private $surname;
    private $notAccessible;

    public function getOne()
    {
        return $this->one;
    }

    public function setOne($one)
    {
        $this->one = $one;
    }

    public function getTwo()
    {
        return $this->two;
    }

    public function setTwo($two)
    {
        $this->two = $two;
    }

    public function getThree()
    {
        return $this->three;
    }

    public function setThree($three)
    {
        $this->three = $three;
    }

    public static function getFour()
    {
        return self::$four;
    }

    public static function setFour($four)
    {
        self::$four = $four;
    }

    public static function getFive()
    {
        return self::$five;
    }

    public static function setFive($five)
    {
        self::$five = $five;
    }

    private function setNotAccessible($notAccessible)
    {
        $this->$notAccessible = $notAccessible;
    }

    private function getNotAccessible($notAccessible)
    {
        return $this->$notAccessible;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

}
