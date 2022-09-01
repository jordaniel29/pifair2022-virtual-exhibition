<?php 
  require_once("services/config.php");
  require_once("services/auth-admin.php");

  // Get youtube link
  $sql = "SELECT * FROM youtube WHERE page='auditorium'";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
  $link = $res["src"];

  if(isset($_POST['save'])){
    $sql = "UPDATE youtube SET src=:src WHERE page='auditorium'";
    $stmt = $db->prepare($sql);
    $params = array(
        ":src" => $_POST['youtube']
    );
    $stmt->execute($params);
    echo '<script type="text/javascript">alert("Youtube link has been updated!")</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PI FAIR 2022 - Admin</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/admin-auditorium.css" />
  </head>
  <body>
    <div class="container">
      <?php include 'admin-navbar.php' ?>
      <h1>Auditorium Youtube Source</h1>
      <form method="post" action="" target="temp">
        <div class="content">
          <input
            class="input"
            type="text"
            name="youtube"
            placeholder="Youtube Source"
            value="<?= $link ?>"
            required
          />
        </div>
        <div class="footer">
          <div class="footer-container">
            <button name="save" type="submit" class="btn btn-orange">Save</button>
          </div>
          <div class="footer-container">
            <a href="admin-instructions" class="btn btn-gray" target="_blank">Instructions</a>
          </div>
        </div>
      </form>
      <iframe name="temp" style="display:none;"></iframe>
    </div>
  </body>
</html>
