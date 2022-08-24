<?php

require_once("services/config.php");
require_once("services/auth-login.php");

$name = "";
$email = "";
$university = "";
$error = "";

if(isset($_POST['register'])){
  // filter input data
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $university = filter_input(INPUT_POST, 'university', FILTER_SANITIZE_STRING);
  // encrypt password
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  
  // menyiapkan query
  $sql = "INSERT INTO user (name, email, password, university, is_admin) 
          VALUES (:name, :email, :password, :university, :is_admin)";
  $stmt = $db->prepare($sql);

  // bind parameter ke query
  $params = array(
      ":name" => $name,
      ":email" => $email,
      ":password" => $password,
      ":university" => $university,
      ":is_admin" => FALSE
  );
  

  // eksekusi query untuk menyimpan ke database dan alihkan ke login
  if ($email == "") {
    $error = "Email not valid";
  }
  else if (strlen($_POST["password"]) < 6) {
    $error = "Password must be a minimum of 6 characters";
  }
  else if ($_POST["password"] != $_POST["confirm_password"]) {
    $error = "Password in 2 fields not the same";
  }
  else {
    try {
      $saved = $stmt->execute($params);
      if ($saved) {
        header("Location: login");
      }
      else {
        $error = "Account failed to register";
      } 
    }
    catch (Exception $e) {
      $error = "Email has been used";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Pifair 2022 - Register</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="css/login-register.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
  </head>
  <body>
    <div class="card card0 border-0 content">
      <div class="row">
        <img src="assets/logo.png" class="logo" />
      </div>
      <div class="row d-flex">
        <div class="col-lg-6">
          <div class="card1 pb-5">
            <div
              class="row px-3 justify-content-center border-line image-container-register"
            >
              <img src="assets/stand.png" class="image-register" />
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <form method="post" action="">
            <div class="card2 card border-0 px-4 pb-5">
              <div class="row px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm">Full Name</h6>
                </label>
                <input
                  class="mb-4"
                  type="text"
                  name="name"
                  placeholder="Enter your full name"
                  value="<?= $name ?>"
                  required
                />
              </div>
              <div class="row px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm">Email Address</h6>
                </label>
                <input
                  class="mb-4"
                  type="text"
                  name="email"
                  placeholder="Enter a valid email address"
                  value="<?= $email ?>"
                  required
                />
              </div>
              <div class="row px-3">
                <label class="mb-1"
                  ><h6 class="mb-0 text-sm">Password</h6></label
                >
                <input
                  class="mb-4"
                  type="password"
                  name="password"
                  placeholder="Enter password"
                  required
                />
              </div>
              <div class="row px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm">Confirm Password</h6>
                </label>
                <input
                  class="mb-4"
                  type="password"
                  name="confirm_password"
                  placeholder="Re-enter password"
                  required
                />
              </div>
              <div class="row px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm">Institute/University</h6>
                </label>
                <input
                  class="mb-4"
                  type="text"
                  name="university"
                  placeholder="Enter your institute/university"
                  value="<?= $university ?>"
                  required
                />
              </div>
              <div class="row mb-1 px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm text-danger"> <?= $error ?> </h6>
                </label>
                <button
                  type="submit"
                  class="btn btn-orange text-center"
                  name="register"
                >
                  Register
                </button>
              </div>
              <div class="row mb-4 px-3">
                <small class="font-weight-bold text-center w-100"
                  >Already have an account?
                  <a class="text-danger" href="login">Login</a></small
                >
              </div>
              <div class="row px-3 mb-4">
                <div class="line"></div>
                <small class="or text-center">Or</small>
                <div class="line"></div>
              </div>
              <a
                class="btn btn-primary btn-lg btn-block google"
                href="services/google-login.php"
                role="button"
              >
                <i class="fa fa-google icon"></i> Register with Google
              </a>
            </div>
          </form>
        </div>
      </div>
      <div class="bg-orange-register py-4">
        <div class="row px-3">
          <small class="ml-4 ml-sm-5 mb-2"
            >Copyright &copy; 2022. All rights reserved.</small
          >
        </div>
      </div>
    </div>
  </body>
</html>
