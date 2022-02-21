<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

// Routing
$map = [
    '/hello' => 'hello.php',
    '/bye' => 'bye.php',
    '/about' => 'about.php'
];

$request = Request::createFromGlobals();
$response = new Response();

$pathInfo = $request->getPathInfo();

if (isset($map[$pathInfo])) {
    extract($request->query->all());
    ob_start();
    include __DIR__ . '/../src/pages/' . $map[$pathInfo];
    $response->setContent(ob_get_clean());
} else {
    $response->setContent("La page demandéée n'existe pas");
    $response->setStatusCode(404);
}

$response->send();