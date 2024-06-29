<?php

declare(strict_types=1);

namespace App\Enum;

enum Language : string
{
    case CZECH = 'cs';
    case SLOVAK = 'sk';
    case ENGLISH = 'en';
    case GERMAN = 'de';
    case ROMANIAN = 'ro';
    case BULGARIAN = 'bg';
    case HUNGARIAN = 'hu';
    case POLISH = 'pl';
}