<?php

    // Define your location project directory in htdocs (EX THE FULL PATH: D:\xampp\htdocs\x-kang\simple-routing-with-php)
    $project_location = "";
    $me = $project_location;

    // For get URL PATH
    $request = $_SERVER['REQUEST_URI'];

    switch ($request) {
        case $me.'/' :
            require "views/login.php";
            break;
        case $me.'/login' :
            require "views/login.php";
            break;
        case $me.'/register' :
            require "views/register.php";
            break;
        case $me.'/gallery' :
            require "views/gallery.php";
            break;
        case $me.'/teather' :
            require "views/teather.php";
            break;
        case $me.'/logout-service' :
            require "services/logout.php";
            break;
        case $me.'/admin' :
            require "views/admin-home.php";
            break;
        case $me.'/admin-auditorium' :
            require "views/admin-auditorium.php";
            break;
        case $me.'/admin-team' :
            require "views/admin-team.php";
            break;
        default:
            http_response_code(404);
            echo "404";
            break;
    }
?>