<?php

require_once("config.php");
require_once("../vendor/autoload.php");

// Google Auth
$clientID = "750289530306-n4pltuqpct5amq1gf4cg9dva6ei7mqpm.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = "http://localhost:3000/services/google-login.php"; //Need to change this

// Creating client request to google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('profile');
$client->addScope('email');

// If user logins using google
if (isset($_GET['code'])){
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token);

  // Getting user profile
  $gauth = new Google_Service_Oauth2($client);
  $google_info = $gauth->userinfo->get();
  $email = $google_info->email;
  $name = $google_info->name;

  // Get user from database
  $sql = "SELECT * FROM user WHERE email=:email";
  $stmt = $db->prepare($sql);
  $params = array(
      ":email" => $email
  );
  $stmt->execute($params);
  
  if ($user = $stmt->fetch(PDO::FETCH_ASSOC)){
    // Login
    // Set cookie
    $token = md5($user["id"] . time());
    setcookie('token', $token, time() +3600*24*7, '/');
    
    // Insert cookie in database
    $sql = "UPDATE user SET token=:token WHERE id=:id";
    $stmt = $db->prepare($sql);
    $params = array(
      ":token" => $token,
      ":id" => $user["id"]
    );
    $stmt->execute($params);

    // Login successfull, redirect to teather 
    if (!isset($user["is_admin"]) || $user["is_admin"] != 1) {
      header("Location: ../teather");
    }
    else {
      header("Location: ../admin-team");
    }
  }
  else {
    // Register
    $sql = "INSERT INTO user (name, email, password, is_admin) 
      VALUES (:name, :email, :password, :is_admin)";
    $stmt = $db->prepare($sql);

    $params = array(
    ":name" => $name,
    ":email" => $email,
    ":password" => "",
    ":is_admin" => FALSE
    );

    $saved = $stmt->execute($params);
    if ($saved) {
      // Set cookie
      $token = md5($email . time());
      setcookie('token', $token, time() +3600*24*7, '/');
      
      // Insert cookie in database
      $sql = "UPDATE user SET token=:token WHERE email=:email";
      $stmt = $db->prepare($sql);
      $params = array(
        ":token" => $token,
        ":email" => $email
      );
      $stmt->execute($params);

      // Redirect to add university
      header("Location: ../add-university");
    }
  }
}
else{
  $url = $client->createAuthUrl();
  header("Location: $url");
}
?>