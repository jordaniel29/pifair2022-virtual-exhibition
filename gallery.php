<?php
  $data = file_get_contents('json/team.json');
  $array = json_decode($data, true);
  echo $array;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Gallery</title>
    <meta name="description" content="Gallery • A-Frame" />
    <script src="js/aframe-master.js"></script>
    <script src="https://unpkg.com/aframe-environment-component@1.3.0/dist/aframe-environment-component.min.js"></script>
    <script src="js/gallery.js"></script>
    <link rel="stylesheet" href="css/teather.css" />
  </head>
  <body>
    <a-scene
      background="color: #212"
      environment
      cursor="rayOrigin: mouse; fuse: false"
      raycaster="objects: .raycastable"
    >
      <a-assets>
        <?php foreach ($array as $team) : ?>
          <img
            id="image-<?= $team["id"] ?>"
            src=<?= $team["image"] ?>
            crossorigin="anonymous"
          />
        <?php endforeach;?>

        <img id="floor" src="assets/floor.jpg" />
        
        <a-mixin
          id="frame"
          geometry="primitive: plane; width: 1.401; height: 1.8345"
          material="color: white; shader: flat"
          animation__scale="property: scale; to: 1.2 1.2 1.2; dur: 200; startEvents: mouseenter"
          animation__scale_reverse="property: scale; to: 1 1 1; dur: 200; startEvents: mouseleave"
        ></a-mixin>
        
        <a-mixin
          id="poster"
          geometry="primitive: plane; width: 1.34; height: 1.7756"
          material="color: white; shader: flat"
          material="shader: flat"
          position="0 0 0.005"
        ></a-mixin>
      </a-assets>

      <a-entity
        id="background"
        position="0 0 0"
        geometry="primitive: sphere; radius: 2.0"
        material="color: red; side: back; shader: flat"
        scale="0.001 0.001 0.001"
        visible="false"
        class="raycastable"
      >
      </a-entity>

      <!-- Camera -->
      <a-entity
        position="0 1.6 0"
        camera
        look-controls="magicWindowTrackingEnabled: true; touchEnabled: true; mouseEnabled: true"
      >
      </a-entity>

      <!-- Hand controls -->
      <a-entity
        id="leftHand"
        laser-controls="hand: left"
        raycaster="objects: .raycastable"
      ></a-entity>
      <a-entity
        id="rightHand"
        laser-controls="hand: right"
        raycaster="objects: .raycastable"
        line="color: #118A7E"
      ></a-entity>

      <!-- Poster menu -->
      <a-entity id="menu" highlight>
        <?php foreach ($array as $team) : ?>
          <a-entity
            id="<?= $team["id"] ?>"
            position= "<?= $team["position"] ?>"
            rotation= "<?= $team["rotation"] ?>"
            mixin="frame"
            class="raycastable menu-button"
          >
            <a-entity
              material="src: #image-<?= $team["id"] ?>;"
              mixin="poster"
            ></a-entity>
            <a-text
              font="https://cdn.aframe.io/fonts/Exo2Bold.fnt"
              value="<?= $team["name"] ?>"
              position="0 -1.1 0.1"
              align="center"
            ></a-text>
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Lighting -->
      <a-entity
        light="type: point; intensity: 0.75; distance: 20; decay: 2"
        position="0 3.5 0"
      ></a-entity>

      <!-- Walls -->
      <a-plane
        position="0 2 -4"
        rotation="0 0 0"
        width="8"
        height="4"
        color="#E1E0DE"
      ></a-plane>
      <a-plane
        position="4 2 0"
        rotation="0 -90 0"
        width="8"
        height="4"
        color="#E1E0DE"
      ></a-plane>
      <a-plane
        position="0 2 4"
        rotation="0 180 0"
        width="8"
        height="4"
        color="#E1E0DE"
      ></a-plane>
      <a-plane
        position="-4 2 0"
        rotation="0 90 0"
        width="8"
        height="4"
        color="#E1E0DE"
      ></a-plane>
      <a-plane
        position="0 0.1 0"
        rotation="-90 0 0"
        width="8"
        height="8"
        src="#floor"
      ></a-plane>
      <a-plane
        position="0 4 0"
        rotation="90 0 0"
        width="8"
        height="8"
        color="#E1E0DE"
      ></a-plane>
    </a-scene>

    <div id="myModal" class="modal">
      <iframe 
        id="myYoutubePlayer"
        class="youtube-player"
        width="900" 
        height="506" 
        src="https://www.youtube.com/embed/yAiCUXWT-QA"
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen
        >
      </iframe>
    </div>
  </body>
</html>
