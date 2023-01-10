<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

if (!defined('DB_FOLDER')) define('DB_FOLDER', ABSPATH . 'database/databases/');

if (!defined('DB_NAME')) {
    define('DB_NAME', DB_FOLDER . 'senzorRebooters.db');
}

require_once ABSPATH . 'database/my_sqlite_class.php';

$GLOBALS['title'] = "Sensor server Rebooters";
