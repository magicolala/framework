<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();
$response = new Response();

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', ['name' => 'World']));
$routes->add('bye', new Route('/bye'));
$routes->add('about', new Route('/about'));

$context = new RequestContext();
$context->fromRequest($request);

$urlMatcher = new UrlMatcher($routes, $context);

$pathInfo = $request->getPathInfo();

try {
    $result = $urlMatcher->match($pathInfo);
    extract($result);
    ob_start();
    include __DIR__ . '/../src/pages/' . $_route . '.php';
    $response->setContent(ob_get_clean());
} catch (ResourceNotFoundException $e) {
    if ($e->getMessage() !== "") {
        echo $e->getMessage();
        echo "\n";
    }
    $response->setContent("La page demandée n'existe pas");
    $response->setStatusCode(404);
}

$response->send();