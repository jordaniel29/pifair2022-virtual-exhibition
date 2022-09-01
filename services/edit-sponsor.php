<?php
  require_once("config.php");
  
  // Get sponsors data
  $data = file_get_contents('../json/sponsors.json');
  $sponsors = json_decode($data, true);

  if (isset($_POST['save'])) {
    foreach ($sponsors as $key => $sponsor) {
      // Update SQL
      $sql = "UPDATE youtube SET src=:src WHERE sponsor_id=:sponsor_id";
      $stmt = $db->prepare($sql);
      $params = array(
          ":src" => $_POST["video-".$sponsor["id"]],
          ":sponsor_id" => $sponsor["id"]
      );
      $stmt->execute($params);
      
      // Update JSON
      $sponsors[$key]["logo"]["url"] = $_POST["logo-".$sponsor["id"]];
      foreach ($sponsor["poster"] as $key2 => $poster) {
        $sponsors[$key]["poster"][$key2]["url"] = $_POST["poster-".$poster["id"]];
      }
    }

    // Put in JSON File 
    file_put_contents('../json/sponsors.json', json_encode($sponsors));
    echo '<script type="text/javascript">alert("List of sponsors have been updated!")</script>';
  }