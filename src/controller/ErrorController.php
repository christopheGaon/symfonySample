<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 25/04/2017
 * Time: 20:00
 */

namespace controller;


use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ErrorController
 * @package controller
 */
class ErrorController
{
    /**
     * @param FlattenException $exception
     * @return Response
     */
    public function exceptionAction(FlattenException $exception)
    {
        $msg = 'Something went wrong! ('.$exception->getMessage().')';

        return new Response($msg, $exception->getStatusCode());
    }
}