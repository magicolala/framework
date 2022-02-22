<?php

use App\Controller\GreetingController;
use App\Controller\PageController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add("hello", new Route("/hello/{name}", [
    "name" => "World",
    "_controller" => [new GreetingController, 'hello']
]));
$routes->add("bye", new Route("/bye", [
    "_controller" => [new GreetingController, "bye"]
]));
$routes->add("about", new Route("/about", [
    "_controller" => [new PageController(), "about"]
]));

return $routes;