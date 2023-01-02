<?php
require_once 'root_vars.php';

$db = new my_sqlite3();
$result = $db->myquery("SELECT sensors.ID, sensors.sensor_name, sensordata.reg_ID, sensordata.date_time, sensordata.temperature_c, sensordata.humidity, sensordata.pm2_5, sensordata.pm10, sensordata.GPS_lat, sensordata.GPS_lon, sensordata.GPS_vit FROM sensors JOIN sensordata ON sensors.ID = sensordata.sensor_ID ORDER BY sensordata.reg_ID DESC");
// reverse array
// $result = array_reverse($result, true);
// var_dump($result);
if (!empty($result)) {
    // send the data as json
    header('Content-Type: application/json');
    echo json_encode($result);
    


    // foreach ($result as $row) {
    //     echo '<tr>';
    //     echo '<th scope="row">' . $row['reg_ID'] . '</th>';
    //     echo '<td>' . $row['sensor_name'] . '</td>';
    //     echo '<td>' . $row['date_time'] . '</td>';
    //     echo '<td>' . $row['temperature_c'] . '</td>';
    //     echo '<td>' . $row['humidity'] . '</td>';
    //     echo '<td>' . $row['pm2_5'] . '</td>';
    //     echo '<td>' . $row['pm10'] . '</td>';
    //     echo '<td>' . $row['GPS_lat'] . '</td>';
    //     echo '<td>' . $row['GPS_lon'] . '</td>';
    //     echo '<td>' . $row['GPS_vit'] . '</td>';
    //     echo '</tr>';
    // }
}
