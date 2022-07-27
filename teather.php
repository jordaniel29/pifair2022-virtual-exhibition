<?php
  $data = file_get_contents('json/video.json');
  $array = json_decode($data, true);
  $link = "https://www.youtube.com/embed/YegJp-E0j0g";
  if (array_key_exists('link', $array)){
    $link = $array['link'];
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Teather</title>
    <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
    <script src="js/teather.js"></script>
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
        <a-asset-item id="theater-obj" src="assets/theater.obj"></a-asset-item>
        <img id="film" src="assets/play.webp" />
        <a-mixin
          id="frame"
          geometry="primitive: plane; width: 8.1; height: 2.85"
          material="color: black; shader: flat"
          animation__scale="property: scale; to: 1.03 1.03 1.03; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
        ></a-mixin>
        <a-mixin
          id="poster"
          geometry="primitive: plane; width: 8; height: 2.75"
          position="-1 1.6 -4.8"
        ></a-mixin>
      </a-assets>

      <!-- Sky -->
      <a-sky color="#400000"></a-sky>

      <!-- Camera -->
      <a-entity
        position="-1 1.6 -0.5"
        camera
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
      >
      </a-entity>

      <a-entity
        obj-model="obj: #theater-obj;"
        material="color:#400000"
        position="-1 -0.25 0"
        scale="0.025 0.025 0.025"
      ></a-entity>

      <a-entity id="menu" video>
        <a-entity
          id="videoButton"
          position="-1 1.6 -4.8"
          mixin="frame"
          class="raycastable menu-button"
        >
          <a-entity
            id="video-screen"
            position="0 0 0.001"
            geometry="primitive:plane; width:8; height:2.75;"
            material="shader:flat; side:double; transparent:true; src:#film"
            mixin="poster"
          ></a-entity>
        </a-entity>
      </a-entity>

      <!-- Walls -->
      <a-plane
        position="-1 3 0"
        rotation="90 0 0"
        width="8.5"
        height="8.5"
        color="#000000"
      ></a-plane>
    </a-scene>
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
