<?php
require_once('conn.php');
// $session_id = $_COOKIE["session_id"]; 
// $update ="UPDATE abbie_certificate WHERE id ='$session_id'"; 
// $conn->query($update);
setcookie("session_id", "");
setcookie("user_username", "");
header('Location: index.php');
?>

