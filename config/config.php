<?php

/**
 * Configuration file
 * 
 * @author Alex Kaydansky <kaydansky@gmail.com>
 * @copyright (c) UbiqiSense ApS
 * @package Capture Video
 * @version 1.0
 * @since 03/05/2018
 */

/**
 * Directory in which your application specific resources are located
 * o No trailing slash
 */
define('APPLICATION_DIR', 'application');

/**
 * Make application directory loaction relative to the document root
 * Define application directory path
 */
if (is_dir(DOC_ROOT . APPLICATION_DIR)) {
    define('APP_PATH', realpath(DOC_ROOT . APPLICATION_DIR) . DIRECTORY_SEPARATOR);
}
else {
    die('Undefined application path');
}

/**
 * Define controllers directory path
 */
define('CONTROLLERS_PATH', APP_PATH . 'controllers' . DIRECTORY_SEPARATOR);

/**
 * Define models directory path
 */
define('MODELS_PATH', APP_PATH . 'models' . DIRECTORY_SEPARATOR);

/**
 * Define views directory path
 */
define('VIEWS_PATH', APP_PATH . 'views' . DIRECTORY_SEPARATOR);

/**
 * Define database directory path
 */
define('DATABASE_PATH', APP_PATH . 'database' . DIRECTORY_SEPARATOR);

/**
 * Define css directory path
 */
define('CSS_PATH', VIEWS_PATH . 'css' . DIRECTORY_SEPARATOR);

/**
 * Define relative path (URI) to css directory
 */
define('CSS_URI', 'application/views/css/');

/**
 * Define js directory path
 */
define('JS_PATH', VIEWS_PATH . 'js' . DIRECTORY_SEPARATOR);

/**
 * Define relative path (URI) to js directory
 */
define('JS_URI', 'application/views/js/');

/**
 * Define relative path (URI) to images directory
 */
define('IMG_URI', 'application/views/img/');

/**
 * Define templates directory path
 */
define('TEMPLATES_PATH', VIEWS_PATH . 'templates' . DIRECTORY_SEPARATOR);

/**
 * Define SQL queries directory path
 */
define('QUERIES_PATH', DATABASE_PATH . 'sql_queries' . DIRECTORY_SEPARATOR);

/**
 * Define helpers directory path
 */
define('HELPER_PATH', APP_PATH . 'helpers' . DIRECTORY_SEPARATOR);

/**
 * Define config directory path
 */
define('CONFIG_PATH', DOC_ROOT . CONFIG_DIR . DIRECTORY_SEPARATOR);

/**
 * Define domain root path
 */
define('DOMAIN_ROOT', '/');

/**
 * Timezone
 */
date_default_timezone_set('Europe/Copenhagen');

/**
 * Locale
 */
setlocale(LC_TIME, array('da_DA.UTF-8', 'da_DA@euro', 'da_DA', 'danish'));

/**
 * Application error log file
 */
define('APP_LOG_FILE', DOC_ROOT . 'logs/errors.txt');

/**
 * Web site base URI
 */
define('BASE_URI', 'http://capture-video');

/**
 * Docs directory path
 */
define('VIDEO_FILES_PATH', DOC_ROOT . 'video' . DIRECTORY_SEPARATOR);

/**
 * Docs URI
 */
define('VIDEO_FILES_URI', 'video/');
