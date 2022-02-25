<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once __DIR__ . "/../vendor/autoload.php";

$request = Request::createFromGlobals();

$routes = require __DIR__ . "/../src/routes.php";

$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

try {
    $result = $urlMatcher->match($request->getPathInfo());
    $request->attributes->add($result);
    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $e) {
    $response = new Response("La page demandée n'existe pas. " . $e->getMessage(), 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue. " . $e->getMessage(), 500);
}

$response->send();