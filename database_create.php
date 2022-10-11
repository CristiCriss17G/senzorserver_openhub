<?php 
$GLOBALS['site_title'] = 'Create database - Sensor server';

include 'header.php';

include_once 'database.php';

?>

<div class="container my-5 py-5">
    <div class="row">
        <div class="col-12">
            <form action="" method="post">
                <div class="form-control">
                    <label class="form-label">Create database table?</label>
                    <input type="hidden" name="create" value="1">
                    <button class="btn btn-primary" type="submit w-100">Create database</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['create'])){
    $db = new DB();
    $db->create_table();
    echo 'Table created';
}


include 'footer.php';
?>