<?php

declare(strict_types=1);

namespace App\Tests;

class DataProvider
{
    public static function getJson(string $filename): string
    {
        $path = __DIR__ . '/data/' . $filename;
        $content = file_get_contents($path);

        return $content;
    }
}