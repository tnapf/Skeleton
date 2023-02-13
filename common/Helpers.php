<?php

namespace Common;

class Helpers {
    public static function render(string $view): string
    {
        return file_get_contents(__DIR__."/../views/{$view}");
    }
}