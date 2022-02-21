<?php

$name = $request->query->get('name', 'World');

$response->headers->set('Content-Type', 'text/html; charset=utf-8');
$response->setContent(sprintf('Hello %s', htmlspecialchars($name, ENT_QUOTES)));