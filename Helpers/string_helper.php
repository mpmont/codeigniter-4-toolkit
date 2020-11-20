<?php

if (!function_exists('getRandomString')) {
    /**
     * Get a random string
     * @param  int      $n The lenght of said string
     * @return string
     */
    function getRandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}

if (!function_exists('transliterateString')) {
    /**
     * Replace special characters for better encoding
     * @param  string $txt   String with special characters
     * @return string String with clean characters
     */
    function transliterateString($txt = null)
    {
        if (is_null($txt)) {
            return '';
        }
        $original_utf8 = $txt; // file must be UTF-8 encoded
        $utf8 = array(
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u' => 'A',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e',
            '/[ÉÈÊË]/u' => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u' => 'O',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U',
            '/ç/' => 'c',
            '/Ç/' => 'C',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/–/' => '-',
            '/[’‘‹›‚]/u' => ' ',
            '/[“”«»„]/u' => ' ',
            '/ /' => ' ',
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $original_utf8);
    }

}

if (!function_exists('decimal_number')) {
    /**
     * Set any number to a set of decimal number eg. 1 = 1.0
     * @param  int      $number  The number to be formated
     * @param  integer  $decimal How many decimals
     * @return double
     */
    function decimal_number($number = null, $decimal = 1)
    {
        if (is_null($number)) {
            return 0;
        }
        return number_format($number, $decimal, '.', ' ');
    }
}

if (!function_exists('round_up')) {
    /**
     * Round up a number
     */
    function round_up($number, $precision = 3)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
}

if (!function_exists('round_down')) {
    /**
     * Round down a number
     */
    function round_down($number, $precision = 3)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (floor($number * $fig) / $fig);
    }
}
