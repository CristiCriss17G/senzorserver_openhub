<?php

// include header
include dirname(__FILE__) . '/header.php';
// Include database class
require_once dirname(__FILE__) . '/database/local_db_secure2.php';


// Create database object
$db = new local_db_secure(dirname(__FILE__) .'/database/databases/db_api.txt', 'a+');

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
    // Create a new api key
    $newKey = bin2hex(random_bytes(32));
    // Get the name from the form
    $name = $_POST['name'];
    // check if the name already exists
    $check = false;
    $keys = $db->read();
    foreach ($keys as $key) {
        if ($key['name'] == $name) {
            $check = true;
            break;
        }
    }

    // Insert the api key and the name into the database if unique
    if (!$check) {
        $db->write(array('name' => $name, 'key' => $newKey));
    } else {
        $newKey = 'Name already exists';
    }
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
include dirname(__FILE__) . '/footer.php';
