<?php

namespace App\Helpers;

use App\Models\LinkMap;
use Illuminate\Support\Str;

class GenerateTinyLink
{
    /**
     * Generate tiny link unique code
     *
     * @param $origin
     * @return string
     */
    public static function generate($origin): string
    {
        return self::generateUniqueRandomString();
    }

    /**
     * generate unique random string
     *
     * @return string
     */
    private static function generateUniqueRandomString(): string
    {
        $randomStr = Str::random(7);
        $linkMapExists = LinkMap::where('tiny_link', $randomStr)->first();
        if ($linkMapExists) {
            return self::generateUniqueRandomString();
        }
        return $randomStr;
    }
}
