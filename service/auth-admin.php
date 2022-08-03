<?php

require_once("service/config.php");

// Get user from database
$sql = "SELECT * FROM user WHERE token=:token";
$stmt = $db->prepare($sql);
$params = array(
    ":token" => $_COOKIE["token"]
);
$stmt->execute($params);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$admin = $user['is_admin'];
$token = $_COOKIE["token"];
// Check if user is not an admin
if (!isset($user["is_admin"]) || $user["is_admin"] != 1) {
    header("Location: teather");
    exit();
}