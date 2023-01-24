<?php

// User authentication section

// DISABLED FOR NOW.
// WILL BE ENABLED AFTER GAME INTEGRATION IS DONE.

if(!isset($_GET["SESSION"])){
  $msg = array(
    "status" => "error",
    "message_short" => "cannot_retrieve_session_id",
    "message" => "Failed to retrieve your session id. Please try logging in and refreshing the page."
  );

  outputMsg($msg);
}

$session = $_GET["SESSION"];
session_id($session);
session_start();

$logged_in = false;

// Check whether the user is logged in or not
if(isset($_SESSION['username'])){
  // Check if the user exists.
  $read = $db -> prepare("SELECT COUNT(*) FROM users WHERE username = :username");
  $read -> bindValue(":username", $_SESSION['username']);
  $read -> execute();

  $result = $read -> fetch();

  $userExists = $result[0];

  if($userExists == 1){
    $logged_in = true;
  }
}

if($logged_in == false){
  session_destroy();

  $msg = array(
    "status" => "error",
    "message_short" => "user_auth_failed",
    "message" => "There was a problem authenticating the current account. Please try logging in and refreshing the page.",
  );

  outputMsg($msg);
}

$username = $_SESSION['username'];
$input = $_POST['data'];

?>