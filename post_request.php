<?php

// Include database class
// require_once 'database.php';

// Include local database class
require_once './database/local_db.php';

// Include local database secure class
require_once './database/local_db_secure.php';

// Create database object
// $db = new DB();

// Create local database object 
$db = new local_db();

// Create local database secure object
$db_secure = new local_db_secure('./database/databases/db_api.txt', 'a+');

// conect
// $db->connect();

// insert post data and if regdate is empty, use NOW()
if (count($_POST) > 0) {
    var_dump($_POST);
    $apikey = isset($_POST['apikey']) ? $_POST['apikey'] : '';
    $regdate = isset($_POST['regdate']) ? $_POST['regdate'] : '';
    $regdata = isset($_POST['regdata']) ? $_POST['regdata'] : '';
    $reggps = isset($_POST['reggps']) ? $_POST['reggps'] : '';
    if (empty($regdate)) {
        date_default_timezone_set('Europe/Bucharest');
        $regdate = date('Y-m-d H:i:s');
    } else {
        $regdate = str_replace('T', ' ', $regdate);
    }

    // check if apikey is valid
    foreach ($db_secure->read() as $row) {
        if ($row['key'] == $apikey) {
            // create associative array with the values
            $data = array(
                'name' => base64_encode($row['name']),
                'regdate' => base64_encode($regdate),
                'regdata' => base64_encode($regdata),
                'reggps' => base64_encode($reggps)

            );
            var_dump($data);
            // insert data
            $db->write($data);

            // $db->insert('registry', array('regdate' => $regdate, 'regdata' => $regdata), array('%s', '%s'));
        }
    }
} else {
    // data can be json
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['apikey'])) {
        $apikey = $data['apikey'];
        $regdate = isset($data['regdate']) ? $data['regdate'] : '';
        $regdata = isset($data['regdata']) ? $data['regdata'] : '';
        $reggps = isset($data['reggps']) ? $data['reggps'] : '';

        if (empty($data['regdate'])) {
            date_default_timezone_set('Europe/Bucharest');
            $data['regdate'] = date('Y-m-d H:i:s');
        } else {
            $data['regdate'] = str_replace('T', ' ', $data['regdate']);
        }

        // check if apikey is valid
        foreach ($db_secure->read() as $row) {
            if ($row['key'] == $apikey) {
                // create associative array with the values
                $data = array(
                    'name' => base64_encode($row['name']),
                    'regdate' => base64_encode($data['regdate']),
                    'regdata' => base64_encode($data['regdata']),
                    'reggps' => base64_encode($data['reggps'])
                );
                // insert data
                $db->write($data);

                // $db->insert('registry', array('regdate' => $regdate, 'regdata' => $regdata), array('%s', '%s'));
            }
        }
    }
}

if (isset($_POST['fromhome'])) {
    header('Location: ./');
    exit;
}
