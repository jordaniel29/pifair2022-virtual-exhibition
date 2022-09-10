<?php
  require_once("config.php");
  
  // Get teams data
  $sql = "SELECT * FROM tv";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $tvs = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($tvs, $res);
  };

  if (isset($_POST['save'])) {
    foreach ($tvs as $tv) {
      $sql = "UPDATE tv SET youtube=:youtube, `image`=:tv_image WHERE id=:id";
      $stmt = $db->prepare($sql);
      $params = array(
        ":id" => $tv["id"],
        ":youtube" => $_POST["youtube-".$tv["id"]],
        ":tv_image" => $_POST["image-".$tv["id"]]
      );
      $stmt->execute($params);
    }
    echo '<script type="text/javascript">alert("List of TVs in Exhibition have been updated!")</script>';
  }