<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/vendor/autoload.php';

// Routing
$map = [
    '/hello' => 'hello.php',
    '/bye' => 'bye.php'
];

$request = Request::createFromGlobals();
$response = new Response();

$pathInfo = $request->getPathInfo();

include __DIR__ . '/src/pages/' . $map[$pathInfo];

$response->send();