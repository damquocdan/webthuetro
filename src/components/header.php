<?php

include '../controllers/user_controller.php';

UserController::init();

?>

<!DOCTYPE php>
<php lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>webchothuephong</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../styles/header.css">

    <link rel="stylesheet" href="../styles/vendors/font-awesome/css/font-awesome.min.css">
  </head>

  <body>
    <div class="container-fluid ">
      <div id="header">
        <header>
          <div class="row">
            <div class="col-md-12" style="padding: 0px;">
              <div class="header bg-secondary">
                <div class="menu w-100 h-100">
                  <nav class="navbar navbar-expand-lg navbar-light bg-danger w-100" style="z-index:10; width:100%">
                    <a class="navbar-brand" href="index.php" style="font-size: 40px;" >House</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="index.php">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="room.php">Phòng thuê<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="cart_invoke.php">Danh sách yêu thích<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="yeezy_view.php">Liên hệ<span class="sr-only">(current)</span></a>
                        </li>
                      </ul>
                      <form class="form-inline my-2 my-lg-0" id="myform" action="search_view.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id=textsearch name="keyword" ;>
                        <btn class="block btn"><i class="fa fa-search" aria-hidden="true" type="submit" onclick="submitform()"></i></btn>
                      </form>
                      <script>
                        function submitform() {
                          document.getElementById('myform').submit();
                        }
                      </script>
                      <ul class="ml-3 navbar-nav">
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                          UserController::destroy();
                        }
                        ?>
                        <li class="nav-item active" style="padding-top: 5px;">
                          <a class="nav-link" href="cart_invoke.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active ">
                          <a class="mr-2 nav-link" href="?action=logout"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo UserController::checkSign() ?> <span class="sr-only">(current)</span></a>
                        </li>
                      </ul>
                    </div>
                  </nav>
                </div>
              </div>
        </header>
      </div>
    </div>
  </body>
</php>