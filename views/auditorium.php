<?php
  require_once "services/auth.php";

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
    <title>Pifair 2022</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <script src="js/aframe-master.js"></script>
    <script src="js/auditorium.js"></script>
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
        <img id="teather" src="assets/auditorium.jpg" />
        <img id="film" src="assets/play.webp" />
      </a-assets>

      <!-- Camera -->
      <a-entity
        position="-1 1.6 -0.5"
        camera
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
      >
      </a-entity>

      <a-sky src="#teather" rotation="0 -90 0"></a-sky>

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
