<?php 

if(!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
}

if(!defined('DB_NAME')) {
    define('DB_NAME', ABSPATH . 'database/databases/senzorRebooters.db');
}

require_once ABSPATH . 'database/my_sqlite_class.php';