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
              <div class="team-title"><?= $sponsor["name"] ?></div>
              <div class="team-column">
                <label class="input-title">Logo URL</label>
                <input name="logo-<?= $sponsor["id"] ?>" class="input" type="text" placeholder="Logo URL" value="<?= $sponsor["logo"]["url"]?>" required />
              </div>
              <div class="team-column">
                <label class="input-title">Video URL</label>
                <input name="video-<?= $sponsor["id"] ?>" class="input" type="text" placeholder="Video URL" value="<?= $sponsor["video"]["url"] ?>" required />
              </div>
              <?php $count = 0 ?>
              <?php foreach ($sponsor["poster"] as $poster) : ?>
                <?php $count += 1 ?>
                <div class="team-column">
                  <label class="input-title">Poster URL <?= $count ?></label>
                  <input name="poster-<?= $poster["id"] ?>" class="input" type="text" placeholder="Poster URL" value="<?= $poster["url"] ?>" required />
                </div>
              <?php endforeach;?>
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
