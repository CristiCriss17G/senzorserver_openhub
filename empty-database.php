<?php

include_once './database/local_db.php';
include_once './database/local_db_secure.php';


// conect
$db = new local_db();

// Create local database secure object
$db_secure = new local_db_secure('./database/databases/db_api.txt', 'a+');


$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['apikey'])) {
    $apikey = $data['apikey'];

    // check if apikey is valid
    foreach ($db_secure->read() as $row) {
        if ($row['key'] == $apikey) {

            $db->delete();
        }
    }
}

// sent json response with success message
echo json_encode(array('success' => true));

