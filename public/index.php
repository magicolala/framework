<?php

use Framework\Simplex;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . "/../vendor/autoload.php";

$request = Request::createFromGlobals();

$framework = new Simplex();

$response = $framework->handle($request);

$response->send();