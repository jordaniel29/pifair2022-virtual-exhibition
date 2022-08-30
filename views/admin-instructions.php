<?php 
  require_once("services/auth-admin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PI FAIR 2022 - Admin</title>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.png">
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/admin-instructions.css" />
</head>
<body>
<div class="container">
      <?php include 'admin-navbar.php' ?>
      <div class="content">
        <h1>How to Change Image</h1>
        <h3>1. Prepare the required image and go to <a href="https://postimages.org/" target="_blank">https://postimages.org</a> </h3>
        <img src="assets/instructions/image-1.png" alt="Image Instuctions 1">
        <h3>2. Click "Choose images" and choose the image that you want to upload (Recommended to only choose 1 image)</h3>
        <img src="assets/instructions/image-2.png" alt="Image Instuctions 2">
        <h3>3. Copy the direct link that is given</h3>
        <img src="assets/instructions/image-3.png" alt="Image Instuctions 3">
        <h3>4. Go to the admin-team page and copy the link to the box of the team </h3>
        <img src="assets/instructions/image-4.png" alt="Image Instuctions 4">
        <h3>5. Click save and wait for the popup to show </h3>
        <img src="assets/instructions/image-5.png" alt="Image Instuctions 5">
      </div>
      <div class="content">
        <h1>How to Change Video</h1>
        <h3>1. Go to the video/livestream on Youtube and right click on the video. Click "Copy embed code" </h3>
        <img src="assets/instructions/video-1.png" alt="Video Instuctions 1">
        <h3>2. Open a notepad or docs and paste the embed code. Select the link in the the src=" " section and copy it </h3>
        <img src="assets/instructions/video-2.png" alt="Video Instuctions 2">
        <h3>3. Paste the link to the box in the team or auditorium section and click Save. Wait for the popup to show up </h3>
        <img src="assets/instructions/video-3.png" alt="Video Instuctions 3">
      </div>
    </div>
</body>
</html>