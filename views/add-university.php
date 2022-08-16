<?php 
  require_once("services/config.php");
  require_once("services/auth.php");

  if(isset($_POST['save'])){
    $sql = "UPDATE user SET university=:university WHERE token=:token";
    $stmt = $db->prepare($sql);
    $params = array(
        ":token" => $_COOKIE["token"],
        ":university" => $_POST["university"]
    );
    $stmt->execute($params);

    header("Location: teather");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pifair 2022 - Admin</title>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/add-university.css" />
  </head>
  <body>
    <div class="container">
      <h1>University/Institution</h1>
      <form method="post" action="">
        <div class="content">
          <input
            class="input"
            type="text"
            name="university"
            placeholder="University/Institution"
            required
          />
        </div>
        <div class="footer">
          <div class="footer-container">
            <button name="save" type="submit" class="btn btn-orange">Save</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
