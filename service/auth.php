<?php

if (!isset($_COOKIE['token'])) {
    header("Location: login");
    exit();
}