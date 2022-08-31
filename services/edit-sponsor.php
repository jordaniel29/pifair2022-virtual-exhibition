<?php
  // Get sponsors data
  $data = file_get_contents('../json/sponsors.json');
  $sponsors = json_decode($data, true);

  if (isset($_POST['save'])) {
    foreach ($sponsors as $key => $sponsor) {
        $sponsors[$key]["logo"]["url"] = $_POST["logo-".$sponsor["id"]];
        $sponsors[$key]["video"]["url"] = $_POST["video-".$sponsor["id"]];
        foreach ($sponsor["poster"] as $key2 => $poster) {
          $sponsors[$key]["poster"][$key2]["url"] = $_POST["poster-".$poster["id"]];
        }
    }
    file_put_contents('../json/sponsors.json', json_encode($sponsors));
    echo '<script type="text/javascript">alert("List of sponsors have been updated!")</script>';
  }