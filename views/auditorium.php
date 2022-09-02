<?php
  require_once "services/config.php";
  require_once "services/auth.php";

  // Get youtube link
  $sql = "SELECT * FROM youtube WHERE page='auditorium'";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
  $link = $res["src"];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PI FAIR 2022 - Energize In Transition</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="js/aframe-master.js"></script>
    <script src="js/auditorium.js"></script>
    <script src="js/door.js"></script>
    <link rel="stylesheet" href="css/auditorium.css" />
  </head>
  <body>
    <a-scene
      vr-mode-ui="enabled: false"
      environment
      cursor="rayOrigin: mouse; fuse: false"
      raycaster="objects: .raycastable"
    >
      <a-assets>
        <a-asset-item id="door-obj" src="assets/door.obj"></a-asset-item>
        <a-asset-item id="door-mtl" src="assets/door.mtl"></a-asset-item>
        
        <img id="teather" src="assets/auditorium.jpg" />
        <img id="film" src="assets/play.webp" />
        
        <a-mixin
          id="door"
          geometry="primitive: plane; width: 4; height: 4"
          material="opacity: 0.0; transparent: true"
          animation__scale="property: scale; to: 0.022 0.032 0.022; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 0.02 0.03 0.02; dur: 200; startEvents: mouseleave"
        ></a-mixin>
      </a-assets>

      <!-- Camera -->
      <a-entity
        position="-1 1.6 -0.5"
        camera
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
      >
      </a-entity>

      <!-- Teather Image -->
      <a-sky src="#teather" rotation="0 -90 0"></a-sky>

      <!-- Screen Object -->
      <a-entity id="menu" video>
        <a-curvedimage
          src="#film"
          radius="6"
          height="2.75"
          position="-1.3 2.2 0"
          theta-length="59"
          rotation="0 150 0"
          animation__scale="property: position; to: -1.3 2.2 0.5; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: position; to: -1.3 2.2 0; dur: 200; startEvents: mouseleave"
          class="raycastable menu-button"
        >
        </a-curvedimage>
      </a-entity>

      
      <!-- Door Object -->
      <a-entity door>
        <a-entity
          id="lobby"
          mixin="door"
          obj-model="obj: #door-obj; mtl: #door-mtl;"
          position="16 -4.5 -23"
          rotation="0 90 0"
          scale="0.02 0.03 0.02"
          class="raycastable menu-button"
        ></a-entity>
      <a-entity door>
    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="myModal" class="modal">
      <iframe 
        id="myYoutubePlayer"
        class="youtube-player"
        width="900" 
        height="506" 
        src=<?= $link ?> 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen
        >
      </iframe>
    </div>
  </body>
</html>
