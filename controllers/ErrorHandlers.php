<?php

namespace Controllers;

use Common\Helpers;
use HttpSoft\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use stdClass;

class ErrorHandlers {
    public static function E404(ServerRequestInterface $req, ResponseInterface $res, stdClass $args): ResponseInterface 
    {
        $html = Helpers::render("404.html");
        $html = str_replace("<uri-here>", $req->getRequestTarget(), $html);

        return new HtmlResponse($html);
    }
    
    public static function E500(ServerRequestInterface $req, ResponseInterface $res, stdClass $args): ResponseInterface 
    {
        $html = Helpers::render("500.html");
        $html = str_replace("<exception-trace-here>", $args->exception, $html);
        $html = str_replace("<uri-here>", $req->getRequestTarget(), $html);
        return new HtmlResponse($html);
    }
}