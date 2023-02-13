<?php

namespace Controllers;

use Common\Helpers;
use HttpSoft\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home {
    public static function handle(ServerRequestInterface $req, ResponseInterface $res): ResponseInterface 
    {
        return new HtmlResponse(Helpers::render("index.html"));
    }
}