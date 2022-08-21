<?php
  require_once "services/config.php";
  require_once "services/auth.php";

  // Get teams data
  $sql = "SELECT * FROM team";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $teams = array(); //Create array to keep all results
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)){
    array_push($teams, $res);
  };

  // Get user
  $sql = "SELECT * FROM user WHERE token=:token";
  $stmt = $db->prepare($sql);
  $params = array(
      ":token" => $_COOKIE["token"]
  );
  $stmt->execute($params);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  $vote_display = array();
  $unvote_display = array();
  if (!isset($user['team_id'])) {
    foreach ($teams as $team) {
      $vote_display[$team['id']] = 'display: block';
      $unvote_display[$team['id']] = 'display: none';
    }
  }
  else{
    foreach ($teams as $team) {
      if ($team['id'] == $user['team_id']) {
        $vote_display[$team['id']] = 'display: none';
        $unvote_display[$team['id']] = 'display: block';
      }
      else {
        $vote_display[$team['id']] = 'display: none';
        $unvote_display[$team['id']] = 'display: none';
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Pifair 2022</title>
    <meta name="description" content="Gallery • A-Frame" />
    <script src="js/aframe-master.js"></script>
    <script src="https://unpkg.com/aframe-environment-component@1.3.0/dist/aframe-environment-component.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/gallery.js"></script>
    <link rel="stylesheet" href="css/gallery.css" />
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
        <?php foreach ($teams as $team) : ?>
          <img
            id="image-<?= $team["id"] ?>"
            src=<?= $team["team_image"] ?>
            crossorigin="anonymous"
          />
        <?php endforeach;?>

        <img id="floor" src="assets/floor.jfif" />
        <img id="wall" src="assets/pifair.png" />
        <img id="wall2" src="assets/pifair2.png" />
        
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
        <?php foreach ($teams as $team) : ?>
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
              value="<?= $team["team_name"] ?>"
              position="0 -1.1 0.1"
              align="center"
            ></a-text>
          </a-entity>
        <?php endforeach;?>
      </a-entity>

      <!-- Lighting -->
      <a-entity
        light="type: point; intensity: 0.75; distance: 13; decay: 2"
        position="0 3.5 0"
      ></a-entity>

      <!-- Walls -->
      <a-plane
        position="0 2 -4"
        rotation="0 0 0"
        width="8"
        height="4"
        src="#wall"
      ></a-plane>
      <a-plane
        position="4 2 0"
        rotation="0 -90 0"
        width="8"
        height="4"
        src="#wall2"
      ></a-plane>
      <a-plane
        position="0 2 4"
        rotation="0 180 0"
        width="8"
        height="4"
        src="#wall"
      ></a-plane>
      <a-plane
        position="-4 2 0"
        rotation="0 90 0"
        width="8"
        height="4"
        src="#wall2"
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
        src="#floor"
      ></a-plane>
    </a-scene>

    <?php include 'navbar.php' ?>

    <div id="myModal" class="background">
      <?php foreach ($teams as $team) : ?>
        <div class="modal" id="modal-<?= $team["id"] ?>">
          <div class="header">
            <?= $team["team_name"] ?>
          </div>
          <div class="body">
            <iframe 
            id="youtube-<?= $team["id"] ?>"
            class="youtube-player"
            width="750" 
            height="422" 
            src="<?= $team["team_youtube"] ?>"
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen
            >
            </iframe>
          </div>
          <div class="footer">
            <button class="btn close" onclick="closeModal('<?= $team['id'] ?>')">Close</button>
            <button type="submit" id="vote-<?= $team['id'] ?>" name="vote" class="btn vote" style="<?= $vote_display[$team['id']] ?>" onclick="vote('<?= $team['id'] ?>', true)">Vote</button>
            <button type="submit" id="unvote-<?= $team['id'] ?>" name="unvote" class="btn unvote" style="<?= $unvote_display[$team['id']] ?>" onclick="vote('<?= $team['id'] ?>', false)">UnVote</button>
          </div>
        </div>
      <?php endforeach;?>
    </div>

    <iframe name="temp" style="display:none;"></iframe>
  </body>
</html>