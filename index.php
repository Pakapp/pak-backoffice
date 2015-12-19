<?php
//define('HOST', 'http://project.dropyourstore.com/pak/');
define('HOST', 'http://localhost:8888/pak/');
require_once 'config/config.php';
$page = isset($_GET['page']) ? $_GET['page'] : '';
if (!isset($_SESSION['PAK_ID'])) {
    $page = 'login';
}
switch ($page) {
  case 'farms':
    $include = 'template/farms.php';
    $active['farms'] = 'active';
    break;
  case 'farm_add':
    $include = 'template/farm_add.php';
    $active['farms'] = 'active';
    break;
  case 'farm_edit':
    $include = 'template/farm_edit.php';
    $active['farms'] = 'active';
    break;
  case 'login':
    $include = 'template/login.php';
    $active['login'] = 'active';
    break;
  case 'logout':
    session_destroy();
    redirect(HOST);
    break;
  default:
    $include = 'template/farms.php';
    $active['index'] = 'active';
    break;
}
?>
  <!doctype html>
  <html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>PAK</title>
    <link rel="stylesheet" href="<?php echo HOST; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>css/sticky-footer-navbar.css">
    <link rel="stylesheet" href="<?php echo HOST; ?>css/sweetalert.css">
    <!--<link rel="stylesheet" href="<?php echo HOST; ?>css/style.min.css">-->
    <script src="<?php echo HOST; ?>js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo HOST; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo HOST; ?>js/sweetalert.min.js"></script>
    <script src="<?php echo HOST; ?>js/jquery.blockUI.js"></script>
  </head>

  <body>
    <!-- navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">PAKPAK</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo HOST; ?>">PAKPAK</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="<?php echo isset($active['index']) ? $active['index'] : ''; ?>"><a href="<?php echo HOST; ?>">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tools<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="<?php echo isset($active['farms']) ? $active['farms'] : ''; ?>"><a href="<?php echo HOST; ?>farms/">Farms</a></li>
                <?php if (isset($_SESSION['PAK_ID']) && $_SESSION['PAK_ID'] != '') {
    ?>
                  <li class=""><a href="<?php echo HOST;
    ?>logout/">Logout</a></li>
                  <?php

} ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- page content -->
    <div class="container">
      <?php include $include; ?>
    </div>
    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <p class="text-muted">Pak</p>
      </div>
    </footer>
  </body>

  </html>
