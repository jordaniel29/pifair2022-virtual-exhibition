<?php
  require_once "services/auth.php";

  $data = file_get_contents('json/sponsors.json');
  $array = json_decode($data, true);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Pifair 2022</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="js/hall.js"></script>
  </head>
  <body>
    <script>
      /* limit-distance for camera component */
      AFRAME.registerComponent("limit-my-distance-hall", {
        init: function () {
          // do nothing
        },

        tick: function () {
          // limit Z
          if (this.el.object3D.position.z > 8.5) {
            this.el.object3D.position.z = 8.5;
          }
          if (this.el.object3D.position.z < -8.5) {
            this.el.object3D.position.z = -8.5;
          }

          // limit X
          if (this.el.object3D.position.x > 8.5) {
            this.el.object3D.position.x = 8.5;
          }
          if (this.el.object3D.position.x < -8.5) {
            this.el.object3D.position.x = -8.5;
          }
        },
      });
    </script>

    <a-scene
      background="color: #212"
      vr-mode-ui="enabled: false"
      environment
      cursor="rayOrigin: mouse; fuse: false"
      raycaster="objects: .raycastable"
    >
      <a-assets>
        <a-asset-item id="hall-obj" src="assets/hallnew.obj"></a-asset-item>
        <a-asset-item id="hall-mtl" src="assets/hallnew.mtl"></a-asset-item>
        <img id="cursor" src="assets/clickme.png" />
        <a-mixin
          id="frame"
          geometry="primitive: plane; width: 0.2; height: 0.2"
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
      <a-sky color="#000000"></a-sky>

      <!-- Camera -->
      <a-entity
        position="-1 1.6 -0.5"
        camera
        limit-my-distance-hall
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
        wasd-controls="acceleration:100"
      >
      </a-entity>

      <a-entity
        obj-model="obj: #hall-obj; mtl: #hall-mtl;"
        position="-1 -0.25 0"
        scale="0.025 0.025 0.025"
      ></a-entity>

      <!-- Poster menu -->
      <a-entity id="menu" highlight>
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

    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="myModal" class="background">
      <?php foreach ($array as $sponsor) : ?>
        <div class="modal" id="modal-<?= $sponsor["id"] ?>">
          <img 
            id="youtube-<?= $sponsor["id"] ?>"
            class="youtube-player"
            width="480" 
            height="270" 
            src="<?= $sponsor["image"] ?>"
            >
          </img>
        </div>
      <?php endforeach;?>
    </div>
  </body>
</html>
