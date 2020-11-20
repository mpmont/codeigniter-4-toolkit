<?php

if (!function_exists('validateDate')) {
    /**
     * Check if a date is valid or not
     * @param  string $date   The date (or date time)
     * @param  string $format The format we want
     * @return bool
     */
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}
