<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 20/04/2017
 * Time: 15:08
 */

namespace model;


/**
 * Class LeapYearModel
 * @package model
 */
class LeapYearModel
{
    /**
     * @param null $year
     * @return bool
     */
    function isLeapYear($year = null) {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
    }
}