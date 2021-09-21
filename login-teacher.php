<?php
  require_once "pdo.php";
  session_start();
  $salt = 'TeAPh*_';

  // Login
  if(isset($_POST['email1']) && isset($_POST['pass1']))  
  {
    if ( strlen($_POST['email1']) < 1 || strlen($_POST['pass1']) < 1 ) {
      $_SESSION['error'] = "Email and password are required";
      header("Location: login-teacher.php");
      return;
    }  else if (strpos($_POST['email1'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login-teacher.php");
        return;
    }else {
      $check = hash('md5', $salt . $_POST['pass1']);
      $stmt = $pdo->prepare('SELECT id, username  FROM teacher WHERE email = :em AND password = :pw');

      $stmt->execute(array(':em' => $_POST['email1'], ':pw' => $check));


      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row !== false) {

        $_SESSION['name'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = 0;
        // Redirect the browser to login-teacher.php

        header("Location: index.php");

        return;
      }
      $_SESSION['error'] = "Incorrect password";
      error_log("Login fail ".$_POST['email1']." $check");
      header("Location: login-teacher.php");
      return;
          
    }
  }

  // Register
  if ( isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['username']) && isset($_POST['cpass'])  ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 || strlen($_POST['username']) < 1 || strlen($_POST['cpass']) < 1) {
        $_SESSION['error'] = "All fields are required";
        header("Location: login-teacher.php");
        return;
    }  else if (strpos($_POST['email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login-teacher.php");
        return;
    }else if($_POST['pass'] !== $_POST['cpass']){
      $_SESSION['error'] = "Confirmed password is not matching with password";
      header("Location: login-teacher.php");
      return;
    }
    else { 
        $em=$_POST['email'];
        $stmt = $pdo->prepare('SELECT * FROM teacher where email = :prof ');
        $stmt->execute(array(":prof" => $_POST['email']));
        $rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
         if (sizeof($rows2) > 0) {        
            $_SESSION['error'] = "Email already exists";
            header("Location: login-teacher.php");
            return;
        }

    
        $check = hash('md5', $salt . $_POST['pass']);
        $stmt = $pdo->prepare('INSERT INTO teacher (username, password, email) VALUES (  :fn, :ln, :em)');

        $stmt->execute(array(
            ':fn' => $_POST['username'],
            ':ln' => $check,
            ':em' => $_POST['email'])
        );
        $_SESSION['success'] = "Successfully Registered. Please Login";
        header("Location: index.php");
        return;
    }
  }
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
    <title>Login-teacher</title>
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
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="login-teacher.php"
                >For Teacher</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login-student.php">For Student</a>
            </li>
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

    <h1 class="text-center mt-5 mb-5">Only For Teachers'</h1>
    <div class="container m-5">
      <div class="row">
        <div class="col mt-5">
          <h3 class="text-center">Login</h3>
          <form class="pt-3" method="post">
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label"
                >Email</label
              >
              <div class="col-sm-10">
                <input type="email" name="email1" class="form-control" id="inputEmail3" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"
                >Password</label
              >
              <div class="col-sm-10">
                <input
                  type="password"
                  name="pass1"
                  class="form-control"
                  id="inputPassword3"
                />
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
        <div class="col">
          <lottie-player
            src="https://assets6.lottiefiles.com/packages/lf20_wbkikrmh.json"
            background="transparent"
            speed="1"
            style="width: 450px; height: 450px"
            loop
            autoplay
          ></lottie-player>
        </div>
        <div class="col pt-5">
          <h3 class="text-center">Register</h3>
          <form class="mt-3" method="post">
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label"
                >Username</label
              >
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="inputEmail3" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label"
                >Email</label
              >
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail3" />
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"
                >Password</label
              >
              <div class="col-sm-10">
                <input
                  type="password"
                  name="pass"
                  class="form-control"
                  id="inputPassword3"
                />
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label"
                >Confirm Password</label
              >
              <div class="col-sm-10">
                <input
                  type="password"
                  name="cpass"
                  class="form-control"
                  id="inputPassword3"
                />
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
          </form>
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
