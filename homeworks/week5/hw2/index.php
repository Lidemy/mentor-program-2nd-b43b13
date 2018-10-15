<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>week4-1</title>
</head>
<style type="text/css">
body {
	background: #074e54;
}
input,textarea {
	outline: none;
}
.wrapper {
	width: 540px;
	margin: 0 auto;
}
.title {
  color: white;
  text-align: center;
  font-size: 31px;
  margin: 12px;
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
</style>

<body>
<div class="wrapper">
	<div class="title">留言板</div>

	<!-- 主留言表單 -->
	<div>
		<form action='add_cmmt.php' method="post" class="form">
			<input type="text" name="nickname" placeholder="暱稱">
			<textarea name="content" placeholder="留言內容" class="form_content"></textarea>
			<input type="hidden" name="parent_id" value='0' />
			<input type="submit" class="btn">
		</form>
	</div>

	<!-- 撈主留言 -->
	<?php
		require_once('conn.php');

		$sql = "SELECT * FROM comments where parent_id=0 ORDER BY time DESC";
		$result = $conn->query($sql);

		if($result->num_rows > 0) {

			while( $row = $result->fetch_assoc()) {
	?>
			<!-- 留言顯示 -->
			<div class="comment">

				<!-- 主要留言 -->
				<div class="nickname"><?php echo $row["nickname"]; ?><span class="time"><?php echo $row["time"]; ?></span></div>
				<div class="content"><?php echo $row["content"]; ?></div>

	<!-- 撈子留言 -->
	<?php

		$sub_sql = "SELECT * FROM comments where parent_id='".$row['id']."' ORDER BY time ASC";
		$sub_result = $conn->query($sub_sql);

		if($sub_result->num_rows > 0) {

			while( $sub_row = $sub_result->fetch_assoc()) {
	?>

			<!-- 子留言 -->
			<div class="sub_comment">
				<div class="nickname"><?php echo $sub_row["nickname"]; ?><span class="time"><?php echo $sub_row["time"]; ?></span></div>
				<div class="content"><?php echo $sub_row["content"]; ?></div>
			</div>

	<?php
			}
		}
	?>
		<!-- 子留言表單 -->
		<div class="sub_comment">
			<a href="javascript:void(0)" id="response">回應▾</a>
			<form action='add_cmmt.php' method="post" class="sub_form">
				<input type="text" name="nickname" placeholder="暱稱">
				<textarea type="text" name="content" placeholder="留言內容" class="sub_form_content"></textarea>
				<input type="hidden" name="parent_id" value="<?php echo $row['id']; ?>"/>
				<input type="submit" class="btn">
			</form>
		</div>
	</div>

	<?php
		}
	}
	?>
</div>
</body>
<!-- <script type="text/javascript">
var sub_form = document.getElementsByClassName('sub_form')[0];
document.getElementById('response').onclick= function () {
	if (sub_form.style.display ==='none') {

		for (var i = 0; i < 1000; i++) {
			document.getElementsByClassName('sub_form')[i].style.display= 'block';
			document.getElementById('response').innerHTML='回應▴';
		}

	} else {

		for (var i = 0; i < 1000; i++) {
			
		document.getElementsByClassName('sub_form')[i].style.display= 'none';
		document.getElementById('response').innerHTML='回應▾';

		}

	}

}


</script> -->
</html>