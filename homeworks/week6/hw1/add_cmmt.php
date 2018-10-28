<?php
	require('conn.php');

 	$session_id= $_COOKIE['session_id'];
	$sql1 = "SELECT abbie_users.id FROM abbie_users LEFT JOIN abbie_certificate on abbie_users.id = abbie_certificate.user_id WHERE abbie_certificate.id = '$session_id'";

	$result1 = $conn->query($sql1);

	$row1= $result1->fetch_assoc();
	
	$user_id = $row1['id'];
	$content = $_POST['content'];
	$parent_id = $_POST['parent_id'];

  if(!empty($_POST['content'])) {

		$sql = "INSERT INTO abbie_comments (user_id, content, parent_id) VALUES ('$user_id', '$content' , $parent_id)";
		
		if( $conn->query($sql) === TRUE ){

			header("Location: index.php");
			
		}else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	} else {
		header("Location: index.php");
	}
	$conn->close();
?>