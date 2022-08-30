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
    <script src="js/lobby.js"></script> -->
    <link rel="stylesheet" href="css/lobby.css" />
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
        <a-mixin
          id="frame"
          geometry="primitive: circle; radius: 0.2"
          material="color: black; shader: flat"
          animation__scale="property: scale; to: 1.1 1.1 1.1; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
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

      <!-- Information menu -->
      <a-entity id="menu" information-menu>
        <a-entity
          id="information"
          position= "-0.69 3.6 0.8"
          rotation= "0 180 0"
          mixin="frame"
          material="color: white"
          scale="1.3 1.3 1.3"
          animation__scale="property: scale; to: 1.6 1.6 1.6; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1.3 1.3 1.3; dur: 200; startEvents: mouseleave"
          class="raycastable menu-button"
        >
        </a-entity>
      </a-entity>

    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="informationModal" class="background">
      <div class="modal">
        <div class="header">Contact Us</div>
        <div class="body">
          <h4 class="contact-info-text">Muhammad Farhan Abdillah</h4>
          <h4 class="contact-info-text">+6281218921012</h4>
        </div>
        <div class="footer">
          <button class="btn close" onclick="closeModal()">Close</button>
        </div>
      </div>
    </div>
  </body>
</html>
