<?php
  require_once "config.php";

  $sql = "UPDATE user SET team_id=:team_id WHERE token=:token";
  $stmt = $db->prepare($sql);    
  if (isset($_POST['vote'])) {
    $params = array(
        ":token" => $_COOKIE["token"],
        ":team_id" => $_POST["team-id"]
    );
    $stmt->execute($params);
  }
  elseif (isset($_POST['unvote'])) {
    $params = array(
        ":token" => $_COOKIE["token"],
        ":team_id" => NULL
    );
    $stmt->execute($params);
  }