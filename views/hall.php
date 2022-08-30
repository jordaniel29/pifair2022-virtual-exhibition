<?php
  require_once "services/auth.php";

  $data = file_get_contents('json/sponsors.json');
  $array = json_decode($data, true);

  $data_logo = file_get_contents('json/sponsor-logo.json');
  $array_logo = json_decode($data_logo, true);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PI FAIR 2022 - Energize In Transition</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="js/hall.js"></script>
    <link rel="stylesheet" href="css/exhibition.css" />
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
        <?php foreach ($array_logo as $sponsor_logo) : ?>
          <img
            id="image-<?= $sponsor_logo["id"] ?>"
            src=<?= $sponsor_logo["image"] ?>
          />
        <?php endforeach;?>
        <a-asset-item id="hall-obj" src="assets/hall.obj"></a-asset-item>
        <a-asset-item id="hall-mtl" src="assets/hall.mtl"></a-asset-item>
        <a-asset-item id="pole-obj" src="assets/pole.obj"></a-asset-item>
        <a-asset-item id="pole-mtl" src="assets/pole.mtl"></a-asset-item>

        <img id="cursor" src="assets/clickme.png" />
        <img id="wallnew3" src="assets/wallnew3.png" />
        <img id="beigewall" src="assets/beige-hall.png" />
        <img id="ceil" src="assets/ceil-hall.png" />
        <img id="floor" src="assets/checkered-hall.png" />

        <a-mixin
          id="frame"
          geometry="primitive: circle; radius: 0.1"
          material="color: black; shader: flat"
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
      </a-assets>

      <!-- Sky -->
      <a-sky color="#cccccc"></a-sky>

      <!-- Camera -->
      <a-entity
        position="-1 1.7 -0.5"
        camera="fov: 50;"
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
        wasd-controls="acceleration:100"
        limit-my-distance-hall
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
        obj-model="obj: #pole-obj; mtl: #pole-mtl;"
        position="3 0 0"
        rotation="0 0 0"
        scale="0.0015 0.0015 0.0015"
      ></a-entity>

      <!-- Poster menu -->
      <a-entity id="menu" highlight-hall>
        <?php foreach ($array as $sponsor) : ?>
          <a-entity
            id="<?= $sponsor["id"] ?>"
            position= "<?= $sponsor["position"] ?>"
            rotation= "<?= $sponsor["rotation"] ?>"
            mixin="frame"
            material="color: green"
            class="raycastable menu-button"
          >
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Logo menu -->
      <a-entity id="menu" highlight-hall>
        <?php foreach ($array_logo as $sponsor_logo) : ?>
          <a-entity
            id="<?= $sponsor_logo["id"] ?>"
            position= "<?= $sponsor_logo["position"] ?>"
            rotation= "<?= $sponsor_logo["rotation"] ?>"
            mixin="logo"
            class="raycastable menu-button"
          >
            <a-entity
              material="src: #image-<?= $sponsor_logo["id"] ?>;"
              mixin="poster"
            ></a-entity>
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Walls -->
      <a-plane
        position="-3.5 3 -14"
        rotation="0 0 0"
        width="32"
        height="6"
        src="#wallnew3"
      ></a-plane>
      <a-plane
        position="11.5 3 -0.5"
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
        position="-19 3 -0.5"
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

    <div id="myModal" class="background">
      <?php foreach ($array as $sponsor) : ?>
        <div class="modal" id="modal-<?= $sponsor["id"] ?>">
          <div class="header">
            <?= $sponsor["name"] ?>
          </div>
          <div class="body">
            <img 
              id="poster-<?= $sponsor["id"] ?>"
              width="480" 
              height="270" 
              src="<?= $sponsor["image"] ?>"
              >
            </img>
          </div>
          <div class="footer">
            <button class="btn close" onclick="closeModal('<?= $sponsor['id'] ?>')">Close</button>
          </div>
        </div>
      <?php endforeach;?>
    </div>
  </body>
</html>
