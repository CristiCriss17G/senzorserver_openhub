<?php
include 'header.php';
// include_once 'database.php';
include_once 'local_db.php';

?>

<div class="container mt-5 py-5">
    <form role="form" method="get" action="./get_request.php">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="mb-2">
                    <label for="regdate" class="form-label">Registry date</label>
                    <input type="datetime-local" class="form-control" id="regdate" name="regdate" aria-describedby="datehelp">
                    <div class="form-text" id="datehelp">To use the current time leave empty</div>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <label for="regdata" class="form-label">Registry data</label>
                <textarea class="form-control" id="regdata" name="regdata" rows="3"></textarea>
            </div>
            <input type="hidden" name="fromhome" value="1">
            <div class="col-md-2"><button type="submit" class="btn btn-primary">Submit</button></div>
        </div>
    </form>
</div>
<hr>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Registry date</th>
                        <th scope="col">Registry data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // $db = new DB();
                    // $result = $db->query('SELECT * FROM registry');
                    // foreach ($result as $row) {
                    //     echo '<tr>';
                    //     echo '<th scope="row">' . $row->id . '</th>';
                    //     echo '<td>' . $row->regdate . '</td>';
                    //     echo '<td>' . $row->regdata . '</td>';
                    //     echo '</tr>';
                    // }

                    $db = new local_db();
                    $result = $db->read();
                    foreach ($result as $id => $row) {
                        echo '<tr>';
                        echo '<th scope="row">' . $id . '</th>';
                        echo '<td>' . $row['regdate'] . '</td>';
                        echo '<td>' . $row['regdata'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>