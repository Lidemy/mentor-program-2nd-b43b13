<?
	require('conn.php');
	setcookie("user_id", '', time()+3600*24);
	setcookie("user_username", '', time()+3600*24);
	header('Location: index.php');


?>