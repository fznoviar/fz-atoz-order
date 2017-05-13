<?php

if (!function_exists('format_currency')) {
    function format_currency($value)
    {
        return number_format($value, 0, ',', '.');
    }
}

if (!function_exists('rand_success_rate')) {
    function rand_success_rate($rate)
    {
        $rand = rand(1, 100);
        if ($rand <= $rate) {
            return true;
        }
        return false;
    }
}

if (!function_exists('is_daylight')) {
    function is_daylight()
    {
        if (Carbon\Carbon::now()->gte(Carbon\Carbon::parse('9 AM')) &&
            Carbon\Carbon::now()->lte(Carbon\Carbon::parse('5 PM'))) {
                return true;
        }
        return false;
    }
}

if (!function_exists('rand_code')) {
    function rand_code($type, $length)
    {
        $code = '';
        switch ($type) {
            case 'letter':
            case 'letters':
                for ($i = 1; $i < $length; $i++) {
                    $code .= chr(rand(65, 90));
                }
                break;
            default:
                $code = null;
                break;
        }
        return $code;
    }
}
