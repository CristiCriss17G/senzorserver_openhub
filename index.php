<?php
include 'header.php';
// include_once 'database.php';
include_once './database/local_db.php';

?>

<div class="container mt-5 py-5">
    <form role="form" method="post" action="./post_request.php">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="mb-2">
                    <label for="regdate" class="form-label">Registry date</label>
                    <input type="datetime-local" step="1" class="form-control" id="regdate" name="regdate" aria-describedby="datehelp">
                    <div class="form-text" id="datehelp">To use the current time leave empty</div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <label for="regdata" class="form-label">Registry data</label>
                <textarea class="form-control" id="regdata" name="regdata" rows="3"></textarea>
            </div>
            <input type="hidden" name="fromhome" value="1">
            <input type="hidden" id="apikey" name="apikey" value="1">
            <div class="col-lg-3 mb-2">
                <label for="reggps" class="form-label">Registry GPS</label>
                <input type="text" class="form-control" id="reggps" name="reggps" aria-describedby="gpsHelp">
                <div class="form-text" id="gpsHelp">To use the current GPS leave empty</div>
            </div>
            <div class="col-lg-2"><button type="submit" class="btn btn-primary">Submit</button></div>
        </div>
    </form>
</div>
<hr>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between">
            <button id="toggle-names" class="btn btn-outline-info">Show names</button>
            <button id="empty-database" class="btn btn-outline-danger">Empty Database</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped no-name" id="data-entries">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" class="name-api">Name</th>
                        <th scope="col">Registry date</th>
                        <th scope="col">Registry data</th>
                        <th scope="col">Registry GPS</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="./assets/js/homeUpdate.js"></script>

<?php
include 'footer.php';
?>