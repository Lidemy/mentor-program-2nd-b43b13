<?php
	require('conn.php');
	$error_msg='';

	if(!empty($_POST['username'])) {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * from abbie_users where username='$username' and password='$password'";
		$result=$conn->query($sql);
		$row = $result->fetch_assoc();
			
		if($result->num_rows > 0){

			setcookie("user_username", $username, time()+3600*24);
			setcookie("user_id", $row['id'], time()+3600*24);
			header("Location: index.php");

		}else {
			$error_msg='登入帳號或密碼錯誤！';
		}
		$conn->close();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>week5-3</title>
</head>
<style type="text/css">
* {
	outline: none;
}
body {
	background: #084f5f;
}
h2 {
	text-align: center;
	color: white;
	margin-bottom: 10px;
	font-size: 30px;
}
input {
    margin-top: 10px;
    font-size: 15px;
    border: none;
    border-bottom: 1px solid #ddd;
    width: 160px;
}
.box {
    background: white;
    width: 250px;
    margin: 0 auto;
    text-align: center;
    border-radius: 5px;
    padding: 20px 0;
}
.send_btn {
	background: #2cbcda;
	border: none;
	border-radius: 4px;
	font-size: 15px;
	color: white;
	margin-top: 20px;
	width: 50px;
}
.container {
	margin-top: 60px;
}
.error {
	color: red;
    padding-right: 20px;
    font-size: 14px;
}
.logo {
    color: #060606;
    font-size: 37px;
    line-height: 44px;
    /* margin: 0 1px; */
    margin-right: 12px;
    background: #f9d32d;
    display: inline-block;
    width: 46px;
    border-radius: 5px;
    height: 46px;
    text-decoration: none;
}
</style>
<body>
	<div class="container">
		<h2><a href="index.php" class="logo">₪</a>登入</h2>
		<div class="box">
			<form method="POST" action="">
			<?
				if($error_msg !== '') {
			?>
				<div class="error"><?echo $error_msg;?></div>
			<?
				}
			?>
				<div><input type="text" name="username" placeholder="帳號"></div>
				<div><input type="password" name="password" placeholder="密碼"></div>
				<input type="submit" class="send_btn" value="確定">
			</form>
		</div>
	</div>
</body>
</html>