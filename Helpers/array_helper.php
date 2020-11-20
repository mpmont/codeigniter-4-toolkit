<?php
/**
 * Convert a multi-dimensional array into a single-dimensional array.
 * @author Sean Cannon, LitmusBox.com | seanc@litmusbox.com
 *
 * @param  array   $array The multi-dimensional array.
 * @return array
 */
if (!function_exists('array_flatten')) {
    function array_flatten($array)
    {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

/*
 * Return array average
 */
if (!function_exists('avg_array')) {
    function avg_array($array)
    {
        if (!is_array($array)) {
            return false;
        }
        if (empty($array)) {
            return 0.0;
        }
        return round((array_sum($array) / count($array)), 1);
    }
}
