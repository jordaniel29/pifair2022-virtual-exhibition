<?php
  require_once "services/auth.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PI FAIR 2022 - Energize In Transition</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="js/aframe-master.js"></script>
    <script src="js/lobby.js"></script>
    <link rel="stylesheet" href="css/lobby.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <a-scene
      vr-mode-ui="enabled: false"
      environment
      cursor="rayOrigin: mouse; fuse: false"
      raycaster="objects: .raycastable"
    >
      <a-assets>
        <img id="lobby" src="assets/lobby.jpg" />
        <img id="logo" src="assets/logo2.png" />
        <img id="info" src="assets/info.png" />
        <a-asset-item id="door-obj" src="assets/door.obj"></a-asset-item>
        <a-asset-item id="door-mtl" src="assets/door.mtl"></a-asset-item>

        <a-mixin
          id="object"
          geometry="primitive: plane; width: 4; height: 4"
          material="opacity: 0.0; transparent: true"
          animation__scale="property: scale; to: 1.6 1.6 1.6; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1.4 1.4 1.4; dur: 200; startEvents: mouseleave"
        ></a-mixin>
      </a-assets>

      <!-- Camera -->
      <a-entity
        position="-1 1.6 -0.5"
        camera
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
      >
      </a-entity>

      <!-- Lobby background -->
      <a-sky src="#lobby" rotation="0 -90 0"></a-sky>
      
      <!-- Left Door -->
      <a-entity highlight-lobby>
        <a-entity
          id="hall"
          mixin="object"
          position="-10 1.7 -13"
          rotation="0 50 0"
          scale="1.4 1.4 1.4"
          class="raycastable menu-button"
        >
          <a-entity
            obj-model="obj: #door-obj; mtl: #door-mtl;"
            rotation="0 180 0"
            position="-0.5 -2 0"
            scale="0.023 0.025 0.025"
          ></a-entity>
          <a-text
            font="https://cdn.aframe.io/fonts/Exo2Bold.fnt"
            value="Hall"
            scale="3.5 3.5 3.5"
            position="-0.5 2.5 1"
            align="center"
          ></a-text>
        </a-entity>
      </a-entity>

      
      <a-entity highlight-lobby>
        <a-entity
          id="exhibition"
          mixin="object"
          position="-15 1.4 1.9"
          rotation="0 90 0"
          scale="1.4 1.4 1.4"
          class="raycastable menu-button"
        >
          <a-entity
            obj-model="obj: #door-obj; mtl: #door-mtl;"
            rotation="0 180 0"
            position="-0.3 -2 0"
            scale="0.025 0.025 0.025"
          ></a-entity>
          <a-text
            font="https://cdn.aframe.io/fonts/Exo2Bold.fnt"
            value="Exhibition"
            scale="3.5 3.5 3.5"
            position="-0.3 2.5 1"
            align="center"
          ></a-text>
        </a-entity>
      </a-entity>
      

      <!-- Right Door -->
      <a-entity highlight-lobby>
        <a-entity
          id="auditorium"
          mixin="object"
          position="9 1.7 -14"
          rotation="0 -60 0"
          scale="1.4 1.4 1.4"
          class="raycastable menu-button"
        >
          <a-entity
            obj-model="obj: #door-obj; mtl: #door-mtl;"
            rotation="0 180 0"
            position="0.5 -2 0"
            scale="0.025 0.025 0.025"
          ></a-entity>
          <a-text
            font="https://cdn.aframe.io/fonts/Exo2Bold.fnt"
            value="Auditorium"
            scale="3.5 3.5 3.5"
            position="0.5 2.5 1"
            align="center"
          ></a-text>
        </a-entity>
      </a-entity>

      <!-- Info Desk -->
      <a-entity highlight-lobby>
        <a-entity
          id="info-desk"
          mixin="object"
          geometry="primitive: plane; width: 4; height: 2.3"
          position="-1.2 0.35 -15"
          rotation="0 0 0"
          scale="1.4 1.4 1.4"
          class="raycastable menu-button"
        >
          <a-image
            width="1"
            height="1"
            src="#info"
            transparent="true"
            position="0 0.6 0" 
            alpha-test="0.5"
          ></a-image>
          <a-text
            font="https://cdn.aframe.io/fonts/Exo2Bold.fnt"
            value="Info Desk"
            scale="3.5 3.5 3.5"
            position="0 -0.5 0"
            color="black"
            align="center"
          ></a-text>
        </a-entity>
      </a-entity>

      <!-- TV -->
      <a-entity highlight-lobby>
        <a-entity
          id="video"
          mixin="object"
          geometry="primitive: plane; width: 3.5; height: 2"
          position="-1 4 -13"
          rotation="0 0 0"
          scale="1.4 1.4 1.4"
          class="raycastable menu-button"
        >
          <a-image
            width="3.5"
            height="2"
            src="#logo"
            transparent="true" 
            alpha-test="0.5"
          ></a-image>
        </a-entity>
      </a-entity>

    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="modalHelpDesk" class="background">
      <div class="modal-contact">
        <div class="header-contact">
          Contact Info
        </div>
        <div class="body-contact">
          <a href="https://wa.me/6281218921012" target="_blank" class="contact">
            <i class="fa fa-whatsapp" style="font-size:48px"></i>
            <span>&nbsp +6281218921012</span>
          </a>
          <a href="https://www.instagram.com/pi.fair/" target="_blank" class="contact">
            <i class="fa fa-instagram" style="font-size:48px"></i>
            <span>&nbsp pi.fair</span>
          </a>
        </div>
      </div>
    </div>

    <div id="modalVideo" class="modal-video">
      <iframe 
        id="myYoutubePlayer"
        class="youtube-player"
        width="900" 
        height="506" 
        src="https://www.youtube.com/embed/YegJp-E0j0g"
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen
        >
      </iframe>
    </div>
  </body>
</html>
