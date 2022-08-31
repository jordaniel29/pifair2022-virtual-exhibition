<?php
  require_once("services/config.php");
  require_once("services/auth-admin.php");

  // Get sponsors data
  $data = file_get_contents('json/sponsors.json');
  $sponsors = json_decode($data, true);
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
      <h1>List of Sponsors</h1>
      <form method="post" action="services/edit-sponsor.php" target="temp">
        <div class="form">
          <?php foreach ($sponsors as $sponsor) : ?>
            <div class="team">
              <div class="team-title"><?= $sponsor["id"] ?></div>
              <div class="team-column">
                <label class="input-title">Name</label>
                <input name="name-<?= $sponsor["id"] ?>" class="input" type="text" placeholder="Name" value="<?= $sponsor["name"]?>" required />
              </div>
              <div class="team-column">
                <label class="input-title">Youtube URL</label>
                <input name="youtube-<?= $sponsor["id"] ?>" class="input" type="text" placeholder="Youtube" value="<?= $sponsor["youtube"] ?>" required />
              </div>
              <div class="team-column">
                <label class="input-title">Image URL</label>
                <input name="image-<?= $sponsor["id"] ?>" class="input" type="text" placeholder="Image" value="<?= $sponsor["image"]?>" required />
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
