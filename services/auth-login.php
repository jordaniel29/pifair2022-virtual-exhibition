<?php

if (isset($_COOKIE['token'])) {
    header("Location: teather");
    exit();
}