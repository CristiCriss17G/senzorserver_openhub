<?php
include 'header.php';
include_once 'database.php';

?>

<div class="container mt-5 py-5">
    <form role="form" method="post" action="./post_request.php">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <label for="regdate" class="input-group-text">Registry date</label>
                    <input type="datetime-local" class="form-control" id="regdate" name="regdate">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" name="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                        Use NOW time
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="regdata" class="form-label">Registry data</label>
                <input type="text" class="form-control" id="regdata" name="regdata" required>
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

                    $db = new DB();
                    $db->connect();
                    $result = $db->query('SELECT * FROM registry');
                    foreach ($result as $row) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row->id . '</th>';
                        echo '<td>' . $row->regdate . '</td>';
                        echo '<td>' . $row->regdata . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>2021-09-01 12:00:00</td>
                        <td>Test data</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>2021-09-01 12:00:00</td>
                        <td>Test data</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>2021-09-01 12:00:00</td>
                        <td>Test data</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php 
include 'footer.php';
?>