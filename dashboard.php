<?php
require_once 'root_vars.php';

$GLOBALS['site_title'] = 'Dashboard - ' . $GLOBALS['site_title'];

include ABSPATH . '/header.php';

?>

<main>
    <section class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-lg-3 d-flex flex-column justify-content-between">
                <div class="accordion" id="accordionData">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="bi bi-cloud-plus me-1"></i> Add data
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionData">
                            <div class="row m-0">
                                <div class="col-md-12">
                                    <form class="my-2" role="form" method="post" action="./post_request.php">
                                        <div class="row align-items-start my-1">
                                            <div class="col-lg-12">
                                                <div class="mb-2">
                                                    <label for="date_time" class="form-label">Registry date</label>
                                                    <input type="datetime-local" step="1" class="form-control" id="date_time" name="date_time" aria-describedby="datehelp">
                                                    <div class="form-text" id="datehelp">To use the current time leave empty</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-start mt-0 mb-1">
                                            <div class="col-lg-6 mb-2">
                                                <label for="temperature_c" class="form-label">Temperature ℃</label>
                                                <input class="form-control" id="temperature_c" name="temperature_c" type="number" step="0.01">
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label for="humidity " class="form-label">Humidity</label>
                                                <input type="number" class="form-control" id="humidity " name="humidity" step="0.01">
                                            </div>
                                        </div>
                                        <div class="row align-items-start mt-0 mb-1">
                                            <div class="col-lg-6 mb-2">
                                                <label for="pm2_5 " class="form-label">Air quality PM 2.5</label>
                                                <input type="number" class="form-control" id="pm2_5 " name="pm2_5" step="0.01">
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label for="pm10 " class="form-label">Air quality PM 10</label>
                                                <input type="number" class="form-control" id="pm10 " name="pm10" step="0.01">
                                            </div>
                                        </div>
                                        <div class="row mt-0 mb-1">
                                            <div class="col-lg-4 mb-2">
                                                <label for="GPS_lat" class="form-label">GPS latitude</label>
                                                <input type="number" class="form-control" id="GPS_lat" name="GPS_lat" step="0.0000001">
                                            </div>
                                            <div class="col-lg-4 mb-2">
                                                <label for="GPS_lon" class="form-label">GPS longitude</label>
                                                <input type="number" class="form-control" id="GPS_lon" name="GPS_lon" step="0.0000001">
                                            </div>
                                            <div class="col-lg-4 mb-2 d-flex flex-column justify-content-between">
                                                <label for="GPS_vit" class="form-label">GPS speed</label>
                                                <input type="number" class="form-control" id="GPS_vit" name="GPS_vit" step="0.01" value="0.0">
                                            </div>
                                        </div>
                                        <div class="row justify-content-center text-center my-1">
                                            <input type="hidden" id="apikey" name="apikey" value="1">
                                            <input type="hidden" name="fromhome" value="1">
                                            <div class="col-lg-6"><button type="submit" class="btn btn-primary w-100">Submit</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="bi bi-clipboard-data me-1"></i> View data
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse show" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionData">
                            <div class="row mt-2 mb-0">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <button id="toggle-names" class="btn btn-outline-info">Show names</button>
                                    <button id="empty-database" class="btn btn-outline-danger">Empty Database</button>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-striped-columns table-hover no-name" id="data-entries">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col" class="name-api">Name</th>
                                                    <th scope="col">Registry date</th>
                                                    <th scope="col">Temperature ℃</th>
                                                    <th scope="col">Humidity</th>
                                                    <th scope="col">Air quality PM 2.5</th>
                                                    <th scope="col">Air quality PM 10</th>
                                                    <th scope="col">GPS latitude</th>
                                                    <th scope="col">GPS longitude</th>
                                                    <th scope="col">GPS speed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row my-1">
                    <a href="./dashboard-legacy.php">
                        <button class="btn btn-outline-secondary w-100">Legacy dashboard</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div id="map" class="w-100"></div>
            </div>
        </div>
    </section>
</main>

<script src="./assets/js/map.js"></script>
<script src="./assets/js/dashboard.js" data-form-api="<?php echo $env['form_api'] ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $env['maps_api'] ?>&callback=initMap&v=weekly" defer></script>

<?php
include ABSPATH . '/footer.php';
?>