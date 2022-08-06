<?php
  require_once "config.php";

  $sql = "UPDATE user SET team_id=:team_id WHERE token=:token";
  $stmt = $db->prepare($sql);
  if (isset($_POST['vote'])) {
    if ($_POST['vote'] == 'true') {
      $params = array(
        ":token" => $_COOKIE["token"],
        ":team_id" => $_POST["team_id"]
      );
    }
    else {
      $params = array(
        ":token" => $_COOKIE["token"],
        ":team_id" => NULL
      );
    }
    $stmt->execute($params);
  }