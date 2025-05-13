<?php

namespace App\Helpers;

use Illuminate\Support\Str;

if (!function_exists('formatDateTime')) {
    /**
     * Format a datetime value or provide a default if it's "-"
     *
     * @param  \Carbon\Carbon|string|null  $dateTime
     * @param  string  $format
     * @return string
     */
    function formatDateTime($dateTime, $format = 'Y-m-d H:i:s')
    {
        if ($dateTime == "-" || $dateTime == null) {
            return "-";
        }

        return ($dateTime instanceof \Carbon\Carbon)
            ? $dateTime->format($format)
            : \Carbon\Carbon::parse($dateTime)->format($format);
    }
}

if (!function_exists('formatCurrency')) {
    /**
     * Format a number as currency with a custom currency symbol.
     *
     * @param float $amount
     * @param string $currencySymbol
     * @return string
     */
    function formatCurrency($amount, $currencySymbol = 'RP')
    {
        return $currencySymbol . ' ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('secondToHms')) {
    function secondToHms($seconds)
    {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
    }
}

if (!function_exists('numberToPercentage')) {
    function numberToPercentage($number, $decimal)
    {
        return number_format($number * 100, $decimal) . '%';
    }
}
