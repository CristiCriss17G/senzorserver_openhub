<?php

require_once 'root_vars.php';


// conect
$db = new my_sqlite3();


$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['apikey'])) {
    $apikey = base64_encode($data['apikey']);

    // check if apikey is valid
    $api_key_check = $db->get_row("SELECT ID FROM sensors WHERE api_key = '{$apikey}'");

    if (!empty($api_key_check)) {
        $db->empty_table('sensordata');
    }

    // sent json response with success message
    echo json_encode(array('success' => true));
} else {
    // sent json response with success message
    echo json_encode(array('success' => false));
}
