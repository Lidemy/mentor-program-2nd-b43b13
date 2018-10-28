<?php
	require('conn.php');

	$error_msg = '';

	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['nickname'])) {

		$nickname = $_POST['nickname'];
		$username = $_POST['username'];
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		
		//避免帳號重複
		$sql= "SELECT * FROM abbie_users where username='$username'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			$error_msg = '此帳號已有人註冊';

		} else {

			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO abbie_users (nickname, username, password) VALUES (?,?,?)");
			$stmt->bind_param("sss", $nickname, $username, $password);
			$stmt->execute();		

			if($stmt){

				setcookie("user_username", $username, time()+3600*24);

				header("Location: login.php");
	
			} else {

				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
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
	margin-top: 210px;
}
.error {
  color: red;
/*  text-align: right;
  padding-right: 14px;*/
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
		<h2><a href="index.php" class="logo">₪</a>註冊</h2>
		<div class="box">		
			<form method="POST" action="register.php">
			<? if($error_msg !== '') {
			?>	
				<div class="error"><?echo $error_msg?></div>	
			<?}
			?>
				<div><input type="text" name="username" placeholder="帳號"></div>
				<div><input type="password" name="password" placeholder="密碼"></div>	
				<div><input type="text" name="nickname" placeholder="暱稱"></div>
				<input type="submit" class="send_btn" value="確定">
			</form>
		</div>
	</div>
</body>
</html>