<?php 

require_once("services/config.php");
require_once("services/auth-login.php");

// Error handling
$error = "";
$email = "";

// If login button is clicked
if(isset($_POST['login'])){

  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $sql = "SELECT * FROM user WHERE email=:email";
  $stmt = $db->prepare($sql);
  $params = array(
      ":email" => $email
  );

  $stmt->execute($params);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // if user exist
  if($user){
    // verify password
    if(password_verify($password, $user["password"])){
        // set cookie
        $token = md5($user["id"] . time());
        setcookie('token', $token, time() +3600*24*7, '/');
        
        // insert cookie in database
        $sql = "UPDATE user SET token=:token WHERE id=:id";
        $stmt = $db->prepare($sql);
        $params = array(
          ":token" => $token,
          ":id" => $user["id"]
        );
        $stmt->execute($params);

        // login successfull, redirect to lobby
        if (!isset($user["is_admin"]) || $user["is_admin"] != 1) {
          header("Location: lobby");
        }
        else {
          header("Location: admin");
        }
    }
    else {
      $error = "Incorrect email/password";
    }
  }
  else {
    $error = "Incorrect email/password";
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
    <title>PI FAIR 2022 - Energize In Transition</title>
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
      <?php include 'navbar-login-register.php' ?>
      <div class="row d-flex">
        <div class="col-lg-6">
          <div class="card1 pb-5">
            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
              <img src="assets/stand.png" class="image-login" />
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <form method="post" action="">
            <div class="card2 card border-0 px-4 py-5">
              <div class="row px-3">
                <label class="mb-1">
                  <h6 class="mb-0 text-sm">Email Address</h6>
                </label>
                <input
                  class="mb-4"
                  type="text"
                  name="email"
                  placeholder="Email Address"
                  value="<?= $email ?>"
                  required
                />
              </div>
              <div class="row px-3">
                <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                <input
                  class="mb-4"
                  type="password"
                  name="password"
                  placeholder="Password"
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
                  name="login"
                >
                  Login
                </button>
              </div>
              <div class="row mb-4 px-3">
                <small class="font-weight-bold text-center w-100"
                  >Don't have an account?
                  <a class="text-danger" href="register">Register</a>
                </small>
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
                <i class="fa fa-google icon"></i> Login with Google
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
