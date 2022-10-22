<?php 
$GLOBALS['site_title'] = 'Create database - Sensor server';

include 'header.php';

include_once 'database/my_sqlite_class.php';

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
                                <li>api_key (VARCHAR(100))</li>
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
                                <li>GPS_lat (REAL)</li>
                                <li>GPS_lon (REAL)</li>
                                <li>boolean (BOOLEAN)</li>
                                <li>float (REAL)</li>
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
// if(isset($_POST['create'])){
//     $db = new DB();
//     $db->create_table();
//     echo 'Table created';
// }


include 'footer.php';
?>