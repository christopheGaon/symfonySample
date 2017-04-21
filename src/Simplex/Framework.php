<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: kokoala
 * Date: 20/04/2017
 * Time: 14:57
 */

namespace Simplex;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

/**
 * Class Framework
 * @package Simplex
 */
class Framework
{
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    /**
     * Framework constructor.
     * @param UrlMatcherInterface $matcher
     * @param ControllerResolverInterface $controllerResolver
     * @param ArgumentResolverInterface $argumentResolver
     */
    public function __construct(UrlMatcherInterface $matcher,
                                ControllerResolverInterface $controllerResolver,
                                ArgumentResolverInterface $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    /**
     * @param Request $request
     * @return mixed|Response
     */
    public function handle(Request $request)
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $error) {
            return new Response('Not Found', 404);
        } catch (\Exception $error) {
            return new Response('An error occurred', 500);
        }
    }
}