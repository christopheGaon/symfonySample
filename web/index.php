<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 19/04/2017
 * Time: 21:08
 */
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/../src/init.php';


include __DIR__.'/../src/route.php';
include __DIR__.'/../src/container.php';

$routes = getRoutes();
$sc = createContainer($routes);
$request = Request::createFromGlobals();

$response = $sc->get('framework')->handle($request);

$response->send();
