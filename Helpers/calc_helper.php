<?php

if (!function_exists('convertToPercent')) {
    /**
     * Convert a value to a percent
     * @param  double   $val1    The first value
     * @param  double   $val2    The second value
     * @param  int      $decimal How many decimal values
     * @return double
     */
    function convertToPercent($val1 = null, $val2 = null, $decimal = 0)
    {
        if (empty($val1) || empty($val2)) {
            return '0';
        }
        if ($val2 == 0) {
            return '0';
        }
        if ($val2 <= 0 || $val1 <= 0) {
            return 0;
        }
        $res = ($val1 * 100) / $val2;
        $res = round($res, $decimal);
        return $res;
    }
}

/**
 * Calc inverted results
 */
if (!function_exists('calcInverted')) {
    function calcInverted($max_score = 0, $min_score = 0, $score = 0)
    {
        if ($score <= $max_score) {
            return 100;
        } else if ($score >= $min_score) {
            return 0;
        } else {
            return (($min_score - $score) * 100) / ($min_score - $max_score);
        }
    }
}
