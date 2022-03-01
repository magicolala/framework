<?php

use Framework\Simplex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

require_once __DIR__ . "/../vendor/autoload.php";

$request = Request::createFromGlobals();

$routes = require __DIR__ . "/../src/routes.php";

$context = new RequestContext();

$urlMatcher = new UrlMatcher($routes, $context);
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Simplex($urlMatcher, $controllerResolver, $argumentResolver);

$response = $framework->handle($request);

$response->send();