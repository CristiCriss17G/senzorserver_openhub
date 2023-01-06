<?php
require_once 'root_vars.php';

$GLOBALS['hero'] = true;

include ABSPATH . '/header.php';

?>

<main>
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Echipa noastra</h2>
                <p>Studenti in cadrul universitatii "Dunarea de Jos" Galati</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="zoom-in">
                        <div class="member-img">
                            <img src="assets/images/team/claudia_anghel.jpg" class="img-fluid" alt="" />
                            <div class="social">
                                <a href="https://www.facebook.com/claudia.anghel.376"><i class="bi bi-facebook"></i></a>
                                <!-- <a href="https://www.instagram.com/creanga_alexandru/"
                      ><i class="bi bi-instagram"></i
                    ></a> -->
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Claudia Anghel</h4>
                            <span>Anul IV ____</span>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="zoom-in" data-aos-delay="100">
                        <div class="member-img">
                            <img src="assets/images/team/Iordachescu.webp" class="img-fluid" alt="" />
                            <div class="social">
                                <a href="https://www.facebook.com/iordachescu.cristian1"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.linkedin.com/in/cristian-iordachescu-83674462/"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Cristian Iordachescu</h4>
                            <span>Anul II Calculatoare</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="zoom-in" data-aos-delay="200">
                        <div class="member-img">
                            <img src="assets/images/team/andrei_labus.jpg" class="img-fluid" alt="" />
                            <div class="social">
                                <a href="https://www.facebook.com/andreilabus.andreilabus"><i class="bi bi-facebook"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Andrei Labus</h4>
                            <span>Anul III ___ </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="zoom-in" data-aos-delay="300">
                        <div class="member-img">
                            <img src="assets/images/team/mihai_podaru.jpg" class="img-fluid" alt="" />
                            <div class="social">
                                <a href="https://www.facebook.com/podaru.mihai.33"><i class="bi bi-facebook"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h4>Mihai Podaru</h4>
                            <span>Anul III ___</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Team Section -->
</main>

<section class="container mt-3 py-4">
    <form role="form" method="post" action="./post_request.php">
        <div class="row align-items-start">
            <div class="col-lg-4">
                <div class="mb-2">
                    <label for="date_time" class="form-label">Registry date</label>
                    <input type="datetime-local" step="1" class="form-control" id="date_time" name="date_time" aria-describedby="datehelp">
                    <div class="form-text" id="datehelp">To use the current time leave empty</div>
                </div>
            </div>
            <div class="col-lg-2 mb-2">
                <label for="temperature_c" class="form-label">Temperature ℃</label>
                <input class="form-control" id="temperature_c" name="temperature_c" type="number" step="0.01">
            </div>
            <div class="col-lg-2 mb-2">
                <label for="humidity " class="form-label">Humidity</label>
                <input type="number" class="form-control" id="humidity " name="humidity" step="0.01">
            </div>
            <div class="col-lg-2 mb-2">
                <label for="pm2_5 " class="form-label">Air quality PM 2.5</label>
                <input type="number" class="form-control" id="pm2_5 " name="pm2_5" step="0.01">
            </div>
            <div class="col-lg-2 mb-2">
                <label for="pm10 " class="form-label">Air quality PM 10</label>
                <input type="number" class="form-control" id="pm10 " name="pm10" step="0.01">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-2">
                <label for="GPS_lat" class="form-label">GPS latitude</label>
                <input type="number" class="form-control" id="GPS_lat" name="GPS_lat" step="0.0000001">
            </div>
            <div class="col-lg-4 mb-2">
                <label for="GPS_lon" class="form-label">GPS longitude</label>
                <input type="number" class="form-control" id="GPS_lon" name="GPS_lon" step="0.0000001">
            </div>
            <div class="col-lg-4 mb-2">
                <label for="GPS_vit" class="form-label">GPS speed</label>
                <input type="number" class="form-control" id="GPS_vit" name="GPS_vit" step="0.01" value="0.0">
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <input type="hidden" id="apikey" name="apikey" value="1">
            <input type="hidden" name="fromhome" value="1">
            <div class="col-lg-4"><button type="submit" class="btn btn-primary w-100">Submit</button></div>
        </div>
    </form>
</section>

<hr class="map-el no-map">
<section class="container my-3 map-el no-map">
    <div class="row">
        <div class="col-12">
            <div id="map"></div>
        </div>
    </div>
</section>

<hr>

<section class="container">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between">
            <button id="toggle-names" class="btn btn-outline-info">Show names</button>
            <button id="toggle-map" class="btn btn-outline-success">Show map</button>
            <button id="empty-database" class="btn btn-outline-danger">Empty Database</button>
        </div>
    </div>
    <div class="row">
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
</section>

<script src="./assets/js/map.js" type="module"></script>
<script src="./assets/js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb6aXaGmNWlFwWSkMALiXf0b5FIEEGnLw&callback=initMap&v=weekly" defer></script>

<?php
include dirname(__FILE__) . '/footer.php';
?>