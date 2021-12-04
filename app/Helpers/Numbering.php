<?php

function short_number($number)
{
    if ($number >= 1000000000000) {
        // At least a trillion
        return $number_format = round(($number / 1000000000000), 2) . 'T';
    } else if ($number >= 1000000000) {
        // At least a billion
        return $number_format = round(($number / 1000000000), 2) . 'B';
    } else if ($number >= 1000000) {
        // Anything less than a million
        return $number_format = round(($number / 1000000), 2) . 'M';
    } else if ($number >= 1000) {
        // Anything less than a kilo
        return $number_format = round(($number / 1000), 2) . 'K';
    } else {
        return $number;
    }
}
