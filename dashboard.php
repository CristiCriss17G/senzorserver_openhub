<?php
require_once 'root_vars.php';

$GLOBALS['title'] = 'Dashboard - ' . $GLOBALS['title'];

include ABSPATH . '/header.php';

?>

<main>
    <section class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
                <div id="map"></div>
            </div>
        </div>
    </section>
</main>