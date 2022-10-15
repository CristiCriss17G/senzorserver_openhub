<?php
include 'header.php';
// include_once 'database.php';
include_once 'local_db.php';

?>

<div class="container mt-5 py-5">
    <form role="form" method="get" action="./get_request.php">
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
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped" id="data-entries" >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
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

<script>
// get content from show_update.php every 10 seconds and put it in the table with the id data-entries without jquery
const tableBody = document.getElementById('data-entries').getElementsByTagName('tbody')[0];
// curent date in seconds
const now = Math.floor(Date.now() / 1000);
const refreshAndGetData = () => {
    fetch('./show_update.php')
    .then(response => response.text())
    .then(data => {
        if(tableBody.innerHTML !== data) {
            tableBody.innerHTML = data;
            clearInterval(refreshInterval);
            console.log(`fast update since ${Math.floor(Date.now() / 1000) - now} seconds`);
            refreshInterval = setInterval(refreshAndGetData, 2000);
        }
        else {
            clearInterval(refreshInterval);
            console.log(`slow update since ${Math.floor(Date.now() / 1000) - now} seconds`);
            refreshInterval = setInterval(refreshAndGetData, 10000);
        }
    });
}
refreshAndGetData();
let refreshInterval = setInterval(refreshAndGetData, 10000);

</script>

<?php
include 'footer.php';
?>