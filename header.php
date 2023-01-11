<?php
require_once 'root_vars.php';

if (!isset($GLOBALS['site_title'])) {
  $GLOBALS['site_title'] = 'Sensor server';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $GLOBALS['site_title']; ?></title>

  <link rel="shortcut icon" href="assets/images/favicon.webp" type="image/webp">

  <meta name="theme-color" content="#2261a0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- externalassets CSS Files -->
  <link rel="stylesheet" href="node_modules/aos/dist/aos.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="node_modules/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="node_modules/glightbox/dist/css/glightbox.min.css">
  <!-- <link rel="stylesheet" href="node_modules/swiper/swiper-bundle.min.css"> -->

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
  <?php
  // display hero only if home page
  if (isset($GLOBALS['hero']) && $GLOBALS['hero']) {
  ?>
    <!-- ======= Hero Section ======= -->
    <section id="hero">
      <div class="hero-container">
        <a href="./" class="hero-logo" data-aos="zoom-in"><img class="img-fluid img-svg" src="assets/images/Rebooters logo.svg" alt="" /></a>
        <h1 data-aos="zoom-in">
          Bine ati venit pe site-ul echipei <span>Rebooters</span>
        </h1>
        <h2 data-aos="fade-up">
          Acesta este site-ul proiectului pentru DanubeAir 2022.
        </h2>
        <a data-aos="fade-up" data-aos-delay="200" href="#team" class="btn-get-started scrollto">Sa incepem!</a>
      </div>
    </section>
    <!-- End Hero -->
  <?php
  }
  ?>

  <header id="header">
    <div class="container d-block d-lg-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
          <a href="./"><img src="assets/images/Rebooters logo.svg" alt="" class="img-fluid img-svg" /></a>
        </div>
        <div class="d-lg-none navbar navbar-expand-lg">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
      <div class="container">
        <nav class="navbar navbar-expand-lg text-center">
          <div class="container-fluid">
            <div class="collapse navbar-collapse pt-4 pt-lg-0" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="./">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./dashboard.php">Dashboard</a>
                  <!-- <ul>
                    <li class="nav-item">
                      <a class="nav-link" href="./dashboard-legacy.php">Dashboard Legacy</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="./post_request.php">Post request</a>
                    </li>
                  </ul> -->
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="./post_request.php">Post request</a>
                </li> -->
                <!-- <li class="nav-item">
                <a class="nav-link" href="./get_request.php">Get request</a>
              </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="./database_create.php">Create database</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./api_generator.php">API Key generator</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>