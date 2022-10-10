<?php 

// Include database class
require_once 'database.php';

// Create database object
$db = new DB();

// conect
// $db->connect();

// insert post data and if regdate is empty, use NOW()
if (isset($_POST['regdata'])) {
    $regdate = $_POST['regdate'];
    $regdata = $_POST['regdata'];
    if (empty($regdate)) {
        $regdate = date('Y-m-d H:i:s');
    }
    $db->insert('registry', array('regdate' => $regdate, 'regdata' => $regdata), array('%s', '%s'));
}

if(isset($_POST['fromhome'])) {
    header('Location: ./');
    exit;
}