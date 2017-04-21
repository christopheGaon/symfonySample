<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 20/04/2017
 * Time: 14:53
 */

namespace controller;


use model\LeapYearModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LeapYearController
 * @package controller
 */
class LeapYearController
{
    /**
     * @param $year
     * @return Response
     */
    public function indexAction($year)
    {
        $leapyear = new LeapYearModel();
        if ($leapyear->isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}