<?php
	require('conn.php');

	$content = $_POST['content'];
	$parent_id = $_POST['parent_id'];
	$user_id = $_COOKIE['user_id'];

	$sql = "INSERT INTO abbie_comments (user_id, content, parent_id) VALUES ($user_id , '$content' , $parent_id)";
	if( $conn->query($sql) === TRUE ){
		header("Location: index.php");
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>