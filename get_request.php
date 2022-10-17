<?php

// Include database class
// require_once 'database.php';

// Include local database class
require_once 'local_db.php';

// Create database object
// $db = new DB();

// Create local database object
$db = new local_db();

// conect
// $db->connect();

// insert post data and if regdate is empty, use NOW()
if (count($_GET) > 0) {
    $regdate = $_GET['regdate'];
    $regdata = $_GET['regdata'];
    $reggps = $_GET['reggps'];
    if (empty($regdate)) {
        date_default_timezone_set('Europe/Bucharest');
        $regdate = date('Y-m-d H:i:s');
    }
    else{
        $regdate = str_replace('T', ' ', $regdate);
    }
    // create associative array with the values
    $data = array(
        'regdate' => base64_encode($regdate),
        'regdata' => base64_encode($regdata),
        'reggps' => base64_encode($reggps)
    );

    // insert data
    $db->write($data);


    // $db->insert('registry', array('regdate' => $regdate, 'regdata' => $regdata), array('%s', '%s'));
}

if (isset($_GET['fromhome'])) {
    header('Location: ./');
    exit;
}
