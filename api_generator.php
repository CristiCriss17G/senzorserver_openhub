<?php
require_once 'root_vars.php';

$GLOBALS['site_title'] = 'API Key Generator - Sensor server';

// include header
include ABSPATH . 'header.php';

?>

<!-- create form to input a name for the api key -->
<div class="container mt-5">
    <form action="" method="post">
        <div class="form-control p-4">
            <label class="form-label mb-4">Create API key</label>
            <input type="text" name="name" class="form-control mb-3" placeholder="Name">
            <input type="hidden" name="create" value="1">
            <button class="btn btn-primary" type="submit w-100">Create API key</button>
        </div>
    </form>
</div>
<?php
// If the form is submitted
if (isset($_POST['create'])) {
    // Create database object
    $db = new my_sqlite3();

    // Create a new api key
    $newKey = bin2hex(random_bytes(32));

    // Get the name from the form
    $name = $_POST['name'];

    // check if the name already exists
    $check = false;
    $keys = $db->get_row("SELECT sensor_name FROM sensors WHERE sensor_name = '$name'");
    if ($keys) {
        $check = true;
    }

    // Insert the api key and the name into the database if unique
    if (!$check) {
        $db->insert('sensors', array(
            'sensor_name' => $name,
            'api_key' => base64_encode($newKey)
        ));
    } else {
        $newKey = 'Name already exists';
    }

    // close the database connection
    $db->close();

    // Show the api key
?>

    <!-- Show the API Key -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="form-control">
                    <label class="form-label">API Key</label>
                    <input type="text" class="form-control" value="<?php echo $newKey; ?>" readonly>
                </div>
            </div>
        </div>
    </div>

<?php
}

// include footer
include ABSPATH . 'footer.php';
