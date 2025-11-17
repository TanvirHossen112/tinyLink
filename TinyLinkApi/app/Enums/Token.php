<?php

namespace App\Enums;

enum Token: int
{
    case TOKEN_TTL_DAYS = 7;
    case REFRESH_TOKEN_TTL_DAYS = 30;
}
