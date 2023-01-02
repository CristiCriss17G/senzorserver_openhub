<?php 
require_once 'root_vars.php';

$GLOBALS['site_title'] = 'Create database - Sensor server';

include 'header.php';

?>

<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12">
            <h2>The following tables will be created</h2>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Table name</th>
                        <th scope="col">Columns</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>sensors</td>
                        <td>
                            <ul>
                                <li>ID (INTEGER, PRIMARY KEY, AUTOINCREMENT)</li>
                                <li>sensor_name (VARCHAR(255), NOT NULL, UNIQUE)</li>
                                <li>api_key (VARCHAR(100), NOT NULL, UNIQUE)</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>sensordata</td>
                        <td>
                            <ul>
                                <li>reg_ID (INTEGER, PRIMARY KEY, AUTOINCREMENT)</li>
                                <li>sensor_ID (INTEGER, FOREIGN KEY, NOT NULL)</li>
                                <li>temperature_c (REAL)</li>
                                <li>humidity (REAL)</li>
                                <li>pm2_5 (REAL)</li>
                                <li>pm10 (REAL)</li>
                                <li>GPS_lat (REAL)</li>
                                <li>GPS_lon (REAL)</li>
                                <li>GPS_vit (REAL)</li>
                                <li>date_time (TEXT)</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="" method="post">
                <div class="form-control">
                    <label class="form-label">Create database table?</label>
                    <input type="hidden" name="create" value="1">
                    <button class="btn btn-primary w-100" type="submit">Create database</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['create'])){
    $db = new my_sqlite3();
    $table1 = $db->maybe_create_table(
        "sensors",
        array(
            'ID' => array('type' => 'INTEGER', 'options' => array('primary_key', 'auto_increment')),
            'sensor_name' => array('type' => 'VARCHAR(255)', 'options' => array('not_null', 'unique')),
            'api_key' => array('type' => 'VARCHAR(100)', 'options' => array('not_null', 'unique')),
        )
    );

    $table2 = $db->maybe_create_table(
        "sensordata",
        array(
            'reg_ID' => array('type' => 'INTEGER', 'options' => array('primary_key', 'auto_increment')),
            'temperature_c' => array('type' => 'REAL'),
            'humidity' => array('type' => 'REAL'),
            'pm2_5' => array('type' => 'REAL'),
            'pm10' => array('type' => 'REAL'),
            'GPS_lat' => array('type' => 'REAL'),
            'GPS_lon' => array('type' => 'REAL'),
            'GPS_vit' => array('type' => 'REAL'),
            'date_time' => array('type' => 'TEXT'),
            'sensor_ID' => array('type' => 'INTEGER', 'options' => array('not_null')),
        ),
        "FOREIGN KEY (sensor_ID) REFERENCES sensors(ID) ON UPDATE CASCADE
        ON DELETE CASCADE"
    );

    if($table1 && $table2){
        echo '<div class="alert alert-success" role="alert">
        Database created successfully!
        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Database creation failed!
        </div>';
        echo $db->lastErrorMsg();
    }

    $db->close();
}


include 'footer.php';
?>