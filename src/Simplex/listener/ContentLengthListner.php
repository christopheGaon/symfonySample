<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 25/04/2017
 * Time: 15:04
 */

namespace Simplex\listener;


use Simplex\event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ContentLengthListner
 * @package Simplex
 */
class ContentLengthListner implements EventSubscriberInterface
{
    /**
     * @param ResponseEvent $event
     */
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

    /**
     * @return mixed
     */
    public static function getSubscribedEvents()
    {
        return array('response' => array('onResponse', -255));
    }
}