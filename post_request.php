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
if (count($_POST) > 0) {
    $regdate = $_POST['regdate'];
    $regdata = $_POST['regdata'];
    if (empty($regdate)) {
        date_default_timezone_set('Europe/Bucharest');
        $regdate = date('Y-m-d H:i:s');
    }
    else {
        $regdate = str_replace('T', ' ', $regdate);
    }
    // create associative array with the values
    $data = array(
        'regdate' => $regdate,
        'regdata' => $regdata
    );

    // insert data
    $db->write($data);
}
else {
    // data can be json
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['regdata'])) {
        if (empty($data['regdate'])) {
            date_default_timezone_set('Europe/Bucharest');
            $data['regdate'] = date('Y-m-d H:i:s');
        }
        else {
            $data['regdate'] = str_replace('T', ' ', $data['regdate']);
        }

        // insert data
        $db->write($data);
    }
}

if (isset($_POST['fromhome'])) {
    header('Location: ./');
    exit;
}
