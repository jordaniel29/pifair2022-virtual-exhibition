<?php

if (isset($_COOKIE['token'])) {
    header("Location: lobby");
    exit();
}