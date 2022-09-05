<?php
  require_once "services/config.php";
  require_once "services/auth.php";

  // Get sponsors from JSON
  $data = file_get_contents('json/sponsors.json');
  $sponsors = json_decode($data, true);

  // Get sponsor's video from SQL
  $sql = "SELECT * FROM youtube WHERE page='exhibition'";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $sponsor_video = array();
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $sponsor_video[$res["sponsor_id"]] = $res["src"];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PI FAIR 2022 - Energize In Transition</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="js/exhibition.js"></script>
    <script src="js/door.js"></script>
    <link rel="stylesheet" href="css/voting.css" />
    <link rel="stylesheet" href="css/exhibition.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <a-scene
      background="color: #212"
      vr-mode-ui="enabled: false"
      environment
      cursor="rayOrigin: mouse; fuse: false"
      raycaster="objects: .raycastable"
    >
      <a-assets>
        <?php foreach ($sponsors as $sponsor) : ?>
          <img
            id="image-<?= $sponsor["id"] ?>"
            src=<?= $sponsor["logo"]["url"] ?>
          />
        <?php endforeach;?>
        <a-asset-item id="hall-obj" src="assets/hall.obj"></a-asset-item>
        <a-asset-item id="hall-mtl" src="assets/hall.mtl"></a-asset-item>
        <a-asset-item id="pole-obj" src="assets/pole.obj"></a-asset-item>
        <a-asset-item id="pole-mtl" src="assets/pole.mtl"></a-asset-item>
        <a-asset-item id="door-obj" src="assets/door.obj"></a-asset-item>
        <a-asset-item id="door-mtl" src="assets/door.mtl"></a-asset-item>

        <img id="wallnew3" src="assets/wallnew3.png" />
        <img id="beigewall" src="assets/beige-exhibition.png" />
        <img id="ceil" src="assets/ceil-exhibition.png" />
        <img id="floor" src="assets/checkered-exhibition.png" />
        <img id="clickme" src="assets/click-me-sm.png" />
        <img id="play" src="assets/play.png" />

        <a-mixin
          id="frame"
          geometry="primitive: circle; radius: 0.1"
          material="color: white; shader: flat"
          animation__scale="property: scale; to: 1.02 1.02 1.02; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
        ></a-mixin>
        <a-mixin
          id="logo"
          geometry="primitive: plane; width: 1.25; height: 0.6"
          animation__scale="property: scale; to: 1.02 1.02 1.02; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
        ></a-mixin>
        <a-mixin
          id="poster"
          geometry="primitive: plane; width: 1.25; height: 0.6"
          material="color: white; shader: flat"
          material="shader: flat"
          position="0 0 0.005"
        ></a-mixin>
        <a-mixin
          id="door"
          geometry="primitive: plane; width: 4; height: 4"
          material="opacity: 0.0; transparent: true"
          animation__scale="property: scale; to: 0.022 0.022 0.022; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 0.02 0.02 0.02; dur: 200; startEvents: mouseleave"
        ></a-mixin>
      </a-assets>

      <!-- Sky -->
      <a-sky color="#cccccc"></a-sky>

      <!-- Camera -->
      <a-entity
        position="-1 1.7 -0.5"
        camera="fov: 50;"
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
        wasd-controls="acceleration:100"
        limit-my-distance-exhibition
      >
      </a-entity>

      <!-- Lighting -->
      <a-entity light="type: ambient; color: #BBB"></a-entity>
      <a-entity 
        light="type: directional; color: #FFF; intensity: 0.2" 
        position="0 3 0"
      >
      </a-entity>

      <a-entity
        obj-model="obj: #hall-obj; mtl: #hall-mtl;"
        position="-1 -0.25 0"
        scale="0.025 0.025 0.025"
      ></a-entity>

      <a-entity
        obj-model="obj: #pole-obj;"
        color="red"
        position="3 0 0"
        rotation="0 0 0"
        scale="0.0015 0.0015 0.0015"
      ></a-entity>

      <!-- Logo menu -->
      <a-entity highlight-exhibition>
        <?php foreach ($sponsors as $sponsor) : ?>
          <a-entity
            id="logo-<?= $sponsor["id"] ?>"
            position= "<?= $sponsor["logo"]["position"] ?>"
            rotation= "<?= $sponsor["logo"]["rotation"] ?>"
            mixin="logo"
            class="raycastable menu-button"
          >
            <a-entity
              material="src: #image-<?= $sponsor["id"] ?>;"
              mixin="poster"
            ></a-entity>
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Video menu -->
      <a-entity highlight-exhibition>
        <?php foreach ($sponsors as $sponsor) : ?>
          <a-entity
            id="video-<?= $sponsor["id"] ?>"
            position= "<?= $sponsor["video"]["position"] ?>"
            rotation= "<?= $sponsor["video"]["rotation"] ?>"
            mixin="frame"
            material="src: #play"
            class="raycastable menu-button"
          >
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Poster menu -->
      <a-entity highlight-exhibition>
        <?php foreach ($sponsors as $sponsor) : ?>
          <?php foreach ($sponsor["poster"] as $poster) : ?>
            <a-entity
              id="poster-<?= $poster["id"] ?>"
              position= "<?= $poster["position"] ?>"
              rotation= "<?= $poster["rotation"] ?>"
              mixin="frame"
              material="src: #clickme"
              class="raycastable menu-button"
            >
            </a-entity>
          <?php endforeach;?>
        <?php endforeach;?>
      </a-entity>

      <!-- Door Object -->
      <a-entity door>
        <a-entity
          id="lobby"
          mixin="door"
          obj-model="obj: #door-obj; mtl: #door-mtl;"
          position="-16 -0.2 0"
          rotation="0 -90 0"
          scale="0.02 0.02 0.02"
          class="raycastable menu-button"
        ></a-entity>
      <a-entity door>

      <!-- Walls -->
      <a-plane
        position="-3.5 3 -14"
        rotation="0 0 0"
        width="32"
        height="6"
        src="#wallnew3"
      ></a-plane>
      <a-plane
        position="9.5 3 -0.5"
        rotation="0 -90 0"
        width="27"
        height="6"
        src="#wallnew3"
      ></a-plane>
      <a-plane
        position="-3.5 3 13"
        rotation="0 180 0"
        width="32"
        height="6"
        src="#wallnew3"
      ></a-plane>
      <a-plane
        position="-15 3 -0.5"
        rotation="0 90 0"
        width="27"
        height="6"
        src="#wallnew3"
      ></a-plane>
      <a-plane
        position="-3.5 0.06 -0.5"
        rotation="-90 0 0"
        width="33"
        height="33"
        src="#floor"
      ></a-plane>
      <a-plane
        position="-3.5 6 -0.5"
        rotation="90 0 0"
        width="33"
        height="33"
        src="#ceil"
      ></a-plane>

    </a-scene>

    <?php include 'navbar.php' ?>

    <!-- WASD Button Right Below -->
    <div class="wasd-container">
      <img src="assets/wasd1.png" class="wasd-image">
    </div>

    <div id="myModal" class="background">
      <!-- Modal For Logo -->
      <?php foreach ($sponsors as $sponsor) : ?>
        <div class="modal" id="modal-logo-<?= $sponsor["id"] ?>">
          <div class="header">
            <?= $sponsor["name"] ?>
          </div>
          <div class="body-contact">
            <a href="https://wa.me/<?= $sponsor["phone"] ?>" target="_blank" class="contact">
              <i class="fa fa-whatsapp" style="font-size:48px"></i>
              <span>&nbsp <?= $sponsor["phone"] ?></span>
            </a>
            <a href="https://www.instagram.com/<?= $sponsor["instagram"]?>" target="_blank" class="contact">
              <i class="fa fa-instagram" style="font-size:48px"></i>
              <span>&nbsp <?= $sponsor["instagram"] ?></span>
            </a>
          </div>
          <div class="footer">
            <button class="btn close" onclick="closeModalLogo('<?= $sponsor['id'] ?>')">Close</button>
          </div>
        </div>
      <?php endforeach;?>

      <!-- Modal for Poster -->
      <?php foreach ($sponsors as $sponsor) : ?>
        <?php foreach ($sponsor["poster"] as $poster) : ?>
          <div class="modal-poster" id="modal-poster-<?= $poster["id"] ?>">
            <div class="header">
              <?= $sponsor["name"] ?>
            </div>
            <div class="body-exhibition">
              <img 
                class="poster-img"
                id="poster-<?= $poster["id"] ?>"
                src="<?= $poster["url"] ?>"
                >
              </img>
            </div>
            <div class="footer-exhibition">
              <button class="btn close" onclick="closeModalPoster('<?= $poster['id'] ?>')">Close</button>
            </div>
          </div>
        <?php endforeach;?>
      <?php endforeach;?>

      <!-- Modal for Video -->
      <?php foreach ($sponsors as $sponsor) : ?>
        <div class="modal" id="modal-video-<?= $sponsor["id"] ?>">
          <div class="header">
            <?= $sponsor["name"] ?>
          </div>
          <div class="body">
            <iframe 
            id="youtube-<?= $sponsor["id"] ?>"
            class="youtube-player"
            width="750" 
            height="422" 
            src="<?= $sponsor_video[$sponsor["id"]] ?>"
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen
            >
            </iframe>
          </div>
          <div class="footer">
            <button class="btn close" onclick="closeModalVideo('<?= $sponsor['id'] ?>')">Close</button>
          </div>
        </div>
      <?php endforeach;?>
    </div>
  </body>
</html>
