<?php
echo'
<link rel="stylesheet" href="css/admin-navbar.css" />
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,1,0"
/>
<div class="admin-navbar">
  <div class="admin-image-row">
    <a href="admin"><img src="assets/logo.png" class="logo" /></a>
  </div>
  <div class="admin-menu-row">
    <a href="admin" class="admin-menu-name">Home</a>
    <a href="admin-team" class="admin-menu-name">Teams</a>
    <a href="admin-auditorium" class="admin-menu-name">Auditorium</a>
    <a href="services/logout.php" class="admin-menu-name logout">
      <span class="material-symbols-outlined icons" style="position: relative; top: 6px;"> logout </span>
      Logout
    </a>
  </div>
</div>';
?>