<?php

namespace Controllers;

use HttpSoft\Message\Response;
use HttpSoft\Message\Stream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use stdClass;
use Tnapf\Router\Exceptions\HttpNotFound;

class Files {
    private static stdClass $mimes;

    public static function handle(RequestInterface $req, ResponseInterface $res): ResponseInterface
    {
        $unreal_file_path = "./public" . str_replace("../", "", $req->getRequestTarget());

        if (!file_exists($unreal_file_path)) {
            return throw new HttpNotFound($req);
        }

        $path_to_file = realpath($unreal_file_path);

        // $file_stream = fopen($path_to_file, "r");
        $file_stream = new Stream("$path_to_file");
        
        return new Response(200, [], $file_stream);
    }

    public static function getMimes(): stdClass
    {
        if (!isset(self::$mimes)) {
            self::$mimes = json_decode(file_get_contents(__DIR__ . "/Mimes.json"));
        }

        return self::$mimes;
    }

    public static function getMimeFromExtension(string $extensionToFindMimeFor): ?string
    {
        foreach (self::getMimes() as $mime => $extensions) {
            foreach ($extensions as $extension) {
                if ($extension == $extensionToFindMimeFor) {
                    return $mime;
                }
            }
        }

        return null;
    }

    public static function generateRegex(): string
    {
        $regex = "";

        foreach (self::getMimes() as $extensions) {
            foreach ($extensions as $extension) {
                $regex .= sprintf(".%s|", $extension);
            }
        }
        
        return substr($regex, 0, -1);
    }
}
