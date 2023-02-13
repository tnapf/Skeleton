<?php

use Controllers\Home;
use Tnapf\Router\Router;

if (PHP_SAPI === "cli-server") {
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $path = pathinfo($url);
    if (!empty($path["extension"])) {
        $file_path = __DIR__."{$path['dirname']}/{$path["basename"]}";
        header("content-type: ".mime_content_type($file_path));
        readfile($file_path);
        return;
    }
}

require_once __DIR__."/../vendor/autoload.php";

Router::get("/", [Home::class, "handle"]);

Router::run();