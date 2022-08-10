<?php
echo'
<link rel="stylesheet" href="../css/admin-navbar.css" />
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,1,0"
/>
<div class="navbar">
  <div class="image-row">
    <img src="../assets/logo.png" class="logo" />
  </div>
  <div class="menu-row">
    <a href="#" class="menu-name">Home</a>
    <a href="/admin-team" class="menu-name">Teams</a>
    <a href="/admin-auditorium" class="menu-name">Auditorium</a>
    <a href="#" class="menu-name">Sponsors</a>
    <a href="/logout-service" class="menu-name logout">
      <span class="material-symbols-outlined icons" style="position: relative; top: 6px;"> logout </span>
      Logout
    </a>
  </div>
</div>';
?>