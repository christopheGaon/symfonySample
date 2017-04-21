<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 19/04/2017
 * Time: 21:04
 */

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
$response = new Response();
$routes = include __DIR__.'/../src/route.php';

/**
 * function qui genere le template
 * @param $request
 * @return Response
 */
function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    /** @noinspection PhpIncludeInspection */
    /** @noinspection PhpUndefinedVariableInspection */
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}
