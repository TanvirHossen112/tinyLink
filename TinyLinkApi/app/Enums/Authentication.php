<?php

namespace App\Enums;

enum Authentication: string
{
    case REFRESH_TOKEN = "REFRESH_TOKEN";
    case API_TOKEN = "API_TOKEN";
}
