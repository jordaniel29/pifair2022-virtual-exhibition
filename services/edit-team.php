<?php
  require_once("config.php");
  
  // Get teams data
  $sql = "SELECT * FROM team";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $teams = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($teams, $res);
  };

  if (isset($_POST['save'])) {
    foreach ($teams as $team) {
      $sql = "UPDATE team SET team_name=:team_name, team_youtube=:team_youtube, team_image=:team_image WHERE id=:id";
      $stmt = $db->prepare($sql);
      $params = array(
        ":id" => $team["id"],
        ":team_name" => $_POST["name-".$team["id"]],
        ":team_youtube" => $_POST["youtube-".$team["id"]],
        ":team_image" => $_POST["image-".$team["id"]]
      );
      $stmt->execute($params);
    }
    echo '<script type="text/javascript">alert("List of teams have been updated!")</script>';
  }