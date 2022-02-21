<?php

use Symfony\Component\HttpFoundation\Response;

$response = new Response("Good Bye!");

$response->send();