<?php

namespace App;

class Helpers
{
    public static function possiblyNull($value)
    {
        return (bool) rand(0, 1) ? $value : null;
    }
}
