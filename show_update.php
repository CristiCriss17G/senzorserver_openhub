<?php
// require local_db.php
require_once 'local_db.php';


$db = new local_db();
$result = $db->read();
// reverse array
$result = array_reverse($result, true);
foreach ($result as $id => $row) {
    echo '<tr>';
    echo '<th scope="row">' . $id . '</th>';
    echo '<td>' . base64_decode($row['regdate']) . '</td>';
    echo '<td>' . str_replace("\n", "<br>", base64_decode($row['regdata'])) . '</td>';
    echo '<td>' . str_replace("\n", "<br>", base64_decode($row['reggps'])) . '</td>';
    echo '</tr>';
}
