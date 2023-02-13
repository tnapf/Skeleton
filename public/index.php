<?php

use Common\Helpers;
use Controllers\ErrorHandlers;
use Controllers\Home;
use Tnapf\Router\Exceptions\HttpInternalServerError;
use Tnapf\Router\Exceptions\HttpNotFound;
use Tnapf\Router\Router;

require_once __DIR__."/../vendor/autoload.php";

if (PHP_SAPI === "cli-server") {
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $path = pathinfo($url);
    if (!empty($path["extension"])) {
        $file_path = __DIR__."{$path['dirname']}/{$path["basename"]}";
        header("content-type: ".Helpers::getMimeFromExtension($path["extension"]));
        readfile($file_path);
        return;
    }
}

Router::get("/", [Home::class, "handle"]);

Router::catch(HttpNotFound::class, [ErrorHandlers::class, "E404"]);
Router::catch(HttpInternalServerError::class, [ErrorHandlers::class, "E500"]);

Router::run();
