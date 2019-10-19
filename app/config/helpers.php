<?php

if (! function_exists('somenteNumeros')) {
    function somenteNumeros($string, $default = null) {
        return preg_replace('/[^0-9]/', '', $string);
    }
}

?>