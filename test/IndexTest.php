<?php

use Framework\Simplex;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class IndexTest extends TestCase
{
    public function testHello()
    {
        $framework = new Simplex;

        $request = Request::create('hello/Lior');
        $response = $framework->handle($request);

        $this->assertEquals('Hello Lior', $response->getContent());
    }
}