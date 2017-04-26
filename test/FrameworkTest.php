<?php
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 20/04/2017
 * Time: 16:01
 */

use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

include __DIR__.'/../src/route.php';
include __DIR__.'/../src/container.php';

class FrameworkTest extends TestCase
{


    public function testErrorHandling()
    {
        $framework = $this->getFrameworkForException(new RuntimeException());

        $response = $framework->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testNotFoundHandling()
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());

        $response = $framework->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    /*public function testControllerResponse()
    {
        $matcher = $this->createMock(UrlMatcherInterface::class);
        $matcher->expects($this->once())
            ->method('match')
            ->will($this->returnValue(array('_route' => 'foo',
                'name' => 'Fabien',
                '_controller' => function ($name) {
                    return new Response('Hello '.$name);
                }
            )))
        ;
        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->createMock(RequestContext::class)))
        ;
        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $framework = new Framework($matcher, $controllerResolver, $argumentResolver);

        $response = $framework->handle(new Request());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello Fabien', $response->getContent());
    }*/

    private function getFrameworkForException($exception)
    {
        $matcher = $this->createMock(UrlMatcherInterface::class);
        /*$matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->throwException($exception))
        ;
        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->createMock(RequestContext::class)))
        ;*/
        $controller_resolver = $this->createMock(ControllerResolver::class);
        $argument_resolver = $this->createMock(ArgumentResolverInterface::class);
        $event_dispatcher = $this->createMock(EventDispatcherInterface::class);
        $request_stack = $this->createMock(RequestStack::class);

        $routes = getRoutes();
        $sc = createContainer($routes);

        //     $sc->register('matcher', get_class($matcher))->setArguments(array($routes, new Reference('context')));

       return   $sc->get('framework');

    }


}
