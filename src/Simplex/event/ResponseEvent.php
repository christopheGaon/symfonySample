<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 25/04/2017
 * Time: 15:06
 */

namespace Simplex\event;




use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseEvent
 * @package Simplex
 */
class ResponseEvent extends Event
{
    private $request;
    private $response;

    /**
     * ResponseEvent constructor.
     * @param $request
     * @param $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getRequest(): Request
    {
        return $this->request;
    }


    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }



}