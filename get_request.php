<?php

// Include database class
require_once 'database.php';

// Create database object
$db = new DB();

// conect
// $db->connect();

// insert post data and if regdate is empty, use NOW()
if (isset($_GET['regdata'])) {
    $regdate = $_GET['regdate'];
    $regdata = $_GET['regdata'];
    if (empty($regdate)) {
        date_default_timezone_set('Europe/Bucharest');
        $regdate = date('Y-m-d H:i:s');
    }
    $db->insert('registry', array('regdate' => $regdate, 'regdata' => $regdata), array('%s', '%s'));
}

if (isset($_GET['fromhome'])) {
    header('Location: ./');
    exit;
}
