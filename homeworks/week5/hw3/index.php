<?
	$is_login = false;
	$user_nickname = '';
	$user_id = '';
	if(isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
		$is_login = true;
		$user_id = $_COOKIE['user_id'];
	} else {

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
body {
	background: #084f5f;
}
input,textarea {
	outline: none;
}
.wrapper {
	width: 540px;
	margin: 0 auto;
	position: relative;
}
.title {
    color: black;
    font-size: 39px;
    width: 50px;
    height: 50px;
    background: #f9d32d;
    position: relative;
    top: -12px;
    border-radius: 5px;
    margin-bottom: 4px;
    margin-top: 4px;
    text-align: center;
    line-height: 44px;
    font-weight: bold;
}
.form_content {
  width: 494px;
  height: 50px;
  margin-top: 5px;
  border: 1px solid #ddd;
}
.btn {
  background: #2cbcda;
  color: white;
  border: none;
  border-radius: 3px;
  width: 70px;
  height: 30px;
  font-size: 15px;
  margin-top: 10px;
}
.comment {
	width: 498px;
  background: white;
  padding: 20px;
  margin-top: 15px;
  border-radius: 5px;
}
.form {
	background: #fff;
  width: 500px;
  padding: 20px;
  border-radius: 5px;
}
input {
	display: block;
}
.nickname {
  border-bottom: 1px solid #ddd;
  position: relative;
  font-weight: bold;
  font-size: 15px;
}
.time {
  position: absolute;
  right: 0; 
  font-size: 12px;
  color: #555;
  top: 3px;
}
.sub_comment {
	background: #eaf6f7;
  margin-left: 21px;
  padding: 10px;
  margin-top: 9px;
  border-radius: 5px;
}
.sub_comment a {
  font-size: 14px;
  text-decoration: none;
  color: #044f60;
}
.content {
    font-size: 13px;
    margin: 4px 0;
}
.sub_form {
	margin-top: 10px;
/*	display: none;*/
}
.sub_form textarea {
	border: 1px solid #ddd;
}
.sub_form_content {
  width: 450px;
  height: 50px;
  margin-top: 5px;
}
.register_btn {
    border-radius: 3px;
    color: white;
    text-decoration: none;
    background: #2cbcda;
    padding: 2px 10px;
    position: absolute;
    right: 0;
    top: 11px;
}
.login_btn {
    border-radius: 3px;
    color: white;
    text-decoration: none;
    background: #2cbcda;
    padding: 2px 10px;
    position: absolute;
    right: 60px;
    top: 11px;
}
.logout_btn {
    border-radius: 3px;
    color: white;
    text-decoration: none;
    background: #2cbcda;
    padding: 2px 10px;
    position: absolute;
    right: 0;
    top: 11px;
}
.login_nickname {
	color: white;
    position: absolute;
    right: 0;
    top: 13px;
    right: 60px;
}
.ur_nickname {
	color: #f9d32d;
    margin: 0 5px;
    font-weight: bold;
}
</style>

<body>
<div class="wrapper">
	<?
		if(!$is_login) {
	?>
			<a href="register.php" class="register_btn">註冊</a>
			<a href="login.php" class="login_btn">登入</a>	

	<?	}
	?>

	<?
		if($is_login) {
	?>
			<div class="login_nickname"><? echo 'Hi,';?><span class="ur_nickname"><?php echo $_COOKIE['user_username']; ?></span><? echo "!";?></div>	
			<a href="logout.php" class="logout_btn">登出</a>	

	<?	}
	?>
	
	<div class="title">₪</div>

	<!-- 撰寫主留言表單 -->
	<div>
		<form action='add_cmmt.php' method="post" class="form">
			<textarea name="content" placeholder="留言內容" class="form_content"></textarea>
			<input type="hidden" name="parent_id" value='0' />
			<?
				if($is_login) {
			?>
				<input type="submit" class="btn" value="送出">

			<?	} else {
			?>
				<input type="submit" class="btn" value="請先登入" disabled>

			<?	}
			?>
		</form>
	</div>

	<!-- 撈主留言 -->
	<?php
		require_once('conn.php');

		$sql = "SELECT comments.id,comments.content,comments.time,users.nickname FROM comments left join users on comments.user_id = users.id where parent_id=0 ORDER BY time DESC";

		$result = $conn->query($sql);

		if($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
	?>
			<!-- 留言顯示 -->
			<div class="comment">

				<!-- 主要留言 -->
				<div class="nickname"><?php echo $row["nickname"]; ?><span class="time"><?php echo $row["time"]; ?></span></div>
				<div class="content"><?php echo $row["content"]; ?></div>

				<!-- 撈子留言 -->
				<?php
					$sub_sql = "SELECT comments.*, users.nickname FROM comments left join users on users.id=comments.user_id  where parent_id='".$row['id']."' ORDER BY time ASC";
					$sub_result = $conn->query($sub_sql);

					if($sub_result->num_rows > 0) {

						while( $sub_row = $sub_result->fetch_assoc()) {
				?>

					<!-- 子留言 -->
					<div class="sub_comment">
						<div class="nickname"><?php echo $sub_row["nickname"]; ?><span class="time"><?php echo $sub_row["time"]; ?></span></div>
						<div class="content"><?php echo $sub_row["content"]; ?></div>
					</div>

				<?
						} //end of while 
					} //end of if
				?>
				<!-- 撰寫子留言表單 -->
				<div class="sub_comment">
					<a href="javascript:void(0)" id="response">回應▾</a>
					<form action='add_cmmt.php' method="post" class="sub_form">
						<textarea type="text" name="content" placeholder="留言內容" class="sub_form_content"></textarea>
						<input type="hidden" name="parent_id" value="<?php echo $row['id']; ?>">
						<?
							if($is_login) {
						?>
							<input type="submit" class="btn" value="送出">

						<?	} else {
						?>
							<input type="submit" class="btn" value="請先登入" disabled>

						<?	}
						?>
						
					</form>
				</div>
			</div>

	<?php
		} //end of while
	} //end of while
	?>
</div>
</body>
</html>