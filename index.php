<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />

    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="index.css" />
    <title>University MIS</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php"
                >Home</a
              >
            </li>
            <?php
              if(isset($_SESSION['id']))
              echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li>';
              else echo '<li class="nav-item">
                          <a class="nav-link" href="login-teacher.php">Login as Teacher</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="login-student.php">Login as Student</a>
                        </li>';
            ?>
          </ul>
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-dark" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <?php
      if(isset($_SESSION['success'])){
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']);
        }
        if(isset($_SESSION['error'])){
        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
        }
    ?>


    <div class="container extra-height">
      <div class="row align-items-center">
        <div class="col">
          <div class="card" style="width: 18rem">
            <lottie-player
              src="https://assets6.lottiefiles.com/packages/lf20_wbkikrmh.json"
              background="transparent"
              speed="1"
              style="width: 300px; height: 300px"
              loop
              autoplay
            ></lottie-player>
            <div class="card-body text-center">
              <a class="btn btn-info text-center" href="login-teacher.php">
                Login as Teacher
              </a>
            </div>
          </div>
        </div>
        <div class="col">
          <lottie-player
            src="https://assets3.lottiefiles.com/private_files/lf30_ysjb4sex.json"
            background="transparent"
            speed="1"
            style="width: 450px; height: 450px"
            loop
            autoplay
          ></lottie-player>
        </div>
        <div class="col">
          <div class="card" style="width: 18rem">
            <lottie-player
              src="https://assets6.lottiefiles.com/packages/lf20_u0w6fbdq.json"
              background="transparent"
              speed="1"
              style="width: 300px; height: 300px"
              loop
              autoplay
            ></lottie-player>
            <div class="card-body text-center">
              <a class="btn btn-info text-center" href="login-student.php">
                Login as Student
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>
