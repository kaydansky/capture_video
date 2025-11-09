<?php

/**
 * Class model Log
 * o Log exceptions
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */
class LogModel {
    
    static function appLog($message) {
        $f = fopen(APP_LOG_FILE, 'a');
        fwrite($f, date('M d, Y H:i:s', time()) . ': ' . $message . "\r\n");
        fclose($f);
    }
}
