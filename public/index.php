<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once __DIR__ . "/../vendor/autoload.php";

$request = Request::createFromGlobals();

$routes = require __DIR__ . "/../src/routes.php";

$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);

try {
    $result= $urlMatcher->match($request->getPathInfo());
    $request->attributes->add($result);
    $response = call_user_func($result['_controller'], $request);
} catch (ResourceNotFoundException $e) {
    $response = new Response("La page demandée n'existe pas. " . $e->getMessage(), 404);
} catch (Exception $e) {
    $response = new Response("Une erreur est survenue. " . $e->getMessage(), 500);
}

$response->send();