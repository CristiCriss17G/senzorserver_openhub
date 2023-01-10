<?php
require_once 'root_vars.php';


// Create local database object 
$db = new my_sqlite3();

$result = array(
    'status' => 'error',
    'message' => 'No data received',
);

// insert post data into database
if (count($_POST) > 0) {
    // var_dump($_POST);

    $received_data = array(
        'apikey' => isset($_POST['apikey']) ? base64_encode($_POST['apikey']) : '',
        'temperature_c' => isset($_POST['temperature_c']) ? floatval($_POST['temperature_c']) : -1.0,
        'humidity' => isset($_POST['humidity']) ? floatval($_POST['humidity']) : -1.0,
        'pm2_5' => isset($_POST['pm2_5']) ? floatval($_POST['pm2_5']) : -1.0,
        'pm10' => isset($_POST['pm10']) ? floatval($_POST['pm10']) : -1.0,
        'GPS_lat' => isset($_POST['GPS_lat']) ? floatval($_POST['GPS_lat']) : -1.0,
        'GPS_lon' => isset($_POST['GPS_lon']) ? floatval($_POST['GPS_lon']) : -1.0,
        'GPS_vit' => isset($_POST['GPS_vit']) ? floatval($_POST['GPS_vit']) : -1.0,
        'date_time' => isset($_POST['date_time']) ? $_POST['date_time'] : '',
    );

    // check of regdate is empty, if so, use NOW()
    if (empty($received_data['date_time'])) {
        date_default_timezone_set('Europe/Bucharest');
        $received_data['date_time'] = date('Y-m-d H:i:s');
    } else {
        $received_data['date_time'] = str_replace('T', ' ', $received_data['date_time']);
    }

    // check if apikey is valid
    $api_key_check = $db->get_row("SELECT ID FROM sensors WHERE api_key = '{$received_data['apikey']}'");

    if ($api_key_check) {
        // apikey is valid, insert data into database
        unset($received_data['apikey']);

        // check data and eliminate empty values or -1.0
        foreach ($received_data as $key => $value) {
            if ($value == -1.0 || empty($value)) {
                unset($received_data[$key]);
            }
        }

        $received_data['sensor_ID'] = $api_key_check['ID'];
        if ($db->insert('sensordata', $received_data)) {
            $result['status'] = 'success';
            $result['message'] = 'Data received';
        }
    }
} else {
    // data can be json
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['apikey'])) {

        $received_data = array(
            'apikey' => isset($data['apikey']) ? base64_encode($data['apikey']) : '',
            'temperature_c' => isset($data['temperature_c']) ? floatval($data['temperature_c']) : -1.0,
            'humidity' => isset($data['humidity']) ? floatval($data['humidity']) : -1.0,
            'pm2_5' => isset($data['pm2_5']) ? floatval($data['pm2_5']) : -1.0,
            'pm10' => isset($data['pm10']) ? floatval($data['pm10']) : -1.0,
            'GPS_lat' => isset($data['GPS_lat']) ? floatval($data['GPS_lat']) : -1.0,
            'GPS_lon' => isset($data['GPS_lon']) ? floatval($data['GPS_lon']) : -1.0,
            'GPS_vit' => isset($data['GPS_vit']) ? floatval($data['GPS_vit']) : -1.0,
            'date_time' => isset($data['date_time']) ? $data['date_time'] : '',
        );

        // check of regdate is empty, if so, use NOW()
        if (empty($received_data['date_time'])) {
            date_default_timezone_set('Europe/Bucharest');
            $received_data['date_time'] = date('Y-m-d H:i:s');
        } else {
            $received_data['date_time'] = str_replace('T', ' ', $received_data['date_time']);
        }

        // check if apikey is valid
        $api_key_check = $db->get_row("SELECT ID FROM sensors WHERE api_key = '{$received_data['apikey']}'");

        if ($api_key_check) {
            // apikey is valid,
            // insert data into database
            unset($received_data['apikey']);

            // check data and eliminate empty values or -1.0
            foreach ($received_data as $key => $value) {
                if ($value == -1.0 || empty($value)) {
                    unset($received_data[$key]);
                }
            }

            $received_data['sensor_ID'] = $api_key_check['ID'];
            if ($db->insert('sensordata', $received_data)) {
                $result['status'] = 'success';
                $result['message'] = 'Data received';
            }
        }
    }
}

// return result
header('Content-Type: application/json');
echo json_encode($result);

if (isset($_POST['fromhome'])) {
    // get page from witch the request was made
    $page = $_SERVER['HTTP_REFERER'];
    // redirect to that page
    header("Location: $page");
    exit;
}
