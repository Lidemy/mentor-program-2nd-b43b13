<?php
	require('conn.php');
	$sql = "INSERT INTO comments (nickname, content, parent_id) VALUES ('" . $_POST['nickname'] . "' , '" . $_POST['content'] . "' , '" . $_POST['parent_id'] . "' )";
	if( $conn->query($sql) === TRUE ){
		header("Location: index.php");
	}else{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>