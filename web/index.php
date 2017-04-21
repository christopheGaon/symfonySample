<watcher/><?php
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 19/04/2017
 * Time: 21:08
 */
require_once __DIR__.'/../src/init.php';


use Simplex\Framework;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;


$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$controller_resolver = new ControllerResolver();
$argument_resolver = new ArgumentResolver();

$framework = new Framework($matcher, $controller_resolver, $argument_resolver);
$response = $framework->handle($request);
$response->send();