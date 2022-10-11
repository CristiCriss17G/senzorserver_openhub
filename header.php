<?php
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
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg text-center bg-warning">
      <div class="container-fluid py-5 p-sm-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="./">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Database settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./post_request.php">Post request</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./get_request.php">Get request</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./database_create.php">Create database</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  </header>