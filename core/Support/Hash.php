<?php

namespace Core\Support;

class Hash
{
    protected static string $algo = PASSWORD_BCRYPT;

    public static function make(string $text)
    {
        return password_hash($text, static::$algo);
    }

    public static function compare(string $plain, string $hashed)
    {
        return password_verify($plain, $hashed);
    }

    public static function info(string $hashed)
    {
        return password_get_info($hashed);
    }

    public static function useAlgo(string $algo = PASSWORD_BCRYPT)
    {
        static::$algo = $algo;
    }
}
