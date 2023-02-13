<?php

namespace Controllers;

use HttpSoft\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home {
    public static function handle(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface 
    {
        return new HtmlResponse(file_get_contents(__DIR__."/../views/index.html"));
    }
}