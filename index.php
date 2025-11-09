<?php

/**
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @copyright (c) UbiqiSense ApS
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */

session_start();

/**
 * The document root path
 */
define('DOC_ROOT', str_replace('\\', '/', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR));

/**
 * Directory in which your configuration file is located.
 * o no trailing slash.
 * 
 * For security reason, it's better to relocate this folder
 * outside the server public directory.
 */
define('CONFIG_DIR', 'config' . DIRECTORY_SEPARATOR);

/**
 * Load configuration
 */
require_once(CONFIG_DIR . 'config.php');

// Run application
require_once(CONTROLLERS_PATH . 'router.php');

new Router;

exit;
