<?php

namespace Database\Factories;

class FactoryHelpers
{
    public static function possiblyNull($value)
    {
        return self::randomBoolean() ? $value : null;
    }

    private static function randomBoolean()
    {
        return (bool) rand(0, 1);
    }
}
