<?php
  require_once("services/config.php");
  require_once("services/auth-admin.php");

  // Get teams data
  $sql = "SELECT * FROM tv";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $tvs = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($tvs, $res);
  };
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
    <link rel="stylesheet" href="css/admin-team-sponsor.css" />
  </head>
  <body>
    <div class="container">
      <?php include "admin-navbar.php" ?>
      <h1>List of TVs in Exhibition</h1>
      <form method="post" action="services/edit-tv.php" target="temp">
        <div class="form">
          <?php foreach ($tvs as $tv) : ?>
            <div class="team">
              <div class="team-title"><?= $tv["id"] ?></div>
              <div class="team-column">
                <label class="input-title">Image URL</label>
                <input name="image-<?= $tv["id"] ?>" class="input" type="text" placeholder="Image" value="<?= $tv["image"]?>" required />
              </div>
              <div class="team-column">
                <label class="input-title">Youtube URL</label>
                <input name="youtube-<?= $tv["id"] ?>" class="input" type="text" placeholder="Youtube" value="<?= $tv["youtube"] ?>" required />
              </div>
            </div>
          <?php endforeach;?>
        </div>
        <div class="footer">
          <div class="footer-container">
            <button type="submit" class="btn btn-orange" name="save">Save</button>
          </div>
          <div class="footer-container">
            <a href="admin-instructions" class="btn btn-gray" target="_blank">Instructions</a>
          </div>
        </div>
      </form>
    </div>
    <iframe name="temp" style="display:none;"></iframe>
  </body>
</html>
