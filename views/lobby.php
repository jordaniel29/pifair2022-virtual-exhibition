<?php
  require_once "services/auth.php";

  $data = file_get_contents('json/rooms.json');
  $array = json_decode($data, true);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Pifair 2022</title>
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <!-- <!-- <script src="js/teather.js"></script> -->
    <script src="js/lobby.js"></script> -->
    <link rel="stylesheet" href="css/teather.css" />
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
        <a-asset-item id="lobby-obj" src="assets/lobby.obj"></a-asset-item>
        <a-asset-item id="lobby-mtl" src="assets/lobby.mtl"></a-asset-item>
        <img id="cursor" src="assets/clickme.png" />
        <a-mixin
          id="frame"
          geometry="primitive: circle; radius: 0.2"
          material="color: black; shader: flat"
          animation__scale="property: scale; to: 1.1 1.1 1.1; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
        ></a-mixin>
        <a-mixin
          id="poster"
          geometry="primitive: plane; width: 8; height: 2.75"
          position="-1 1.6 -4.8"
        ></a-mixin>
      </a-assets>

      <!-- Sky -->
      <a-sky color="#cccccc"></a-sky>

      <!-- Camera -->
      <a-entity id="rig" position="-0.7 1.6 -10" rotation="0 180 0">
        <a-entity
          camera="fov: 50;"
          look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
        >
        </a-entity>
      </a-entity>

      <a-entity
        obj-model="obj: #lobby-obj; mtl: #lobby-mtl;"
        position="0 -0.25 0"
        scale="0.025 0.025 0.025"
      ></a-entity>

      <!-- Poster menu -->
      <a-entity id="menu" highlight>
        <?php foreach ($array as $room) : ?>
          <a-entity
            id="<?= $room["id"] ?>"
            position= "<?= $room["position"] ?>"
            rotation= "<?= $room["rotation"] ?>"
            mixin="frame"
            material="color: white"
            class="raycastable menu-button"
          >
          </a-entity>
        <?php endforeach;?>
      </a-entity>

    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="myModal" class="background">
      <?php foreach ($array as $room) : ?>
        <div class="modal" id="modal-<?= $room["id"] ?>">
          <img 
            id="youtube-<?= $room["id"] ?>"
            class="youtube-player"
            width="480" 
            height="270" 
            src="<?= $room["image"] ?>"
            >
          </img>
        </div>
      <?php endforeach;?>
    </div>
  </body>
</html>
