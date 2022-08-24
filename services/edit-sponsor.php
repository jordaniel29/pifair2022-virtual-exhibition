<?php
  // Get sponsors data
  $data = file_get_contents('../json/sponsors.json');
  $sponsors = json_decode($data, true);

  if (isset($_POST['save'])) {
    foreach ($sponsors as $key => $sponsor) {
        $sponsors[$key]["name"] = $_POST["name-".$sponsor["id"]];
        $sponsors[$key]["youtube"] = $_POST["youtube-".$sponsor["id"]];
        $sponsors[$key]["image"] = $_POST["image-".$sponsor["id"]];
    }
    file_put_contents('../json/sponsors.json', json_encode($sponsors));
    echo '<script type="text/javascript">alert("List of sponsors have been updated!")</script>';
  }