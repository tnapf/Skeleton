<?php

namespace Common;

class Helpers {
    public static function render(string $view): string
    {
        return file_get_contents(__DIR__."/../views/{$view}");
    }

    public static function getMimeFromExtension(string $extensionToFindMimeFor): ?string
    {
        $mimes = json_decode(file_get_contents(__DIR__ . "/Mimes.json"));

        foreach ($mimes as $mime => $extensions) {
            foreach ($extensions as $extension) {
                if ($extension == $extensionToFindMimeFor) {
                    return $mime;
                }
            }
        }

        return null;
    }
}
