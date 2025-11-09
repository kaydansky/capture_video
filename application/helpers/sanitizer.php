<?php

/**
 * Class helper Sanitizer
 * o Sanitize values to make it safe
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */

class Sanitizer {
    
    /**
     * 
     * @todo Add required option as needed
     * @param string $string
     * @param integer $length
     * @return string
     */
    static function string($string, $length = 1000) {
        if (!$string) {
            return false;
        }
        
        $s = trim(substr(strip_tags($string), 0, $length));
        
        return $s;
    }
}
