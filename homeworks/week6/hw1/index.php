<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>week5-3</title>
	<link rel="stylesheet" type="text/css" href="board.css">
	<!-- <script type="text/javascript" src="script.js"></script> -->
</head>
<script type="text/javascript">

document.addEventListener('DOMContentLoaded', ()=>{
	
	let container = document.querySelector('.wrapper');
	container.addEventListener('click', e =>{



		//編輯完成按鍵處理
		if(e.target.className === 'cmmt_edited'){

			var content = e.target.parentNode.parentNode.nextElementSibling;
			var cmmt_id = content.nextElementSibling;
						
			var req = new XMLHttpRequest();
			req.onreadystatechange = () => {

				if( req.status >= 200 && req.status < 400 ){

					console.log(req.responseText);
					if(req.responseText === 'modified') {

						window.location.reload();
					}

				}
			}

			req.open( 'POST', 'cmmt_modify.php', true );
			req.setRequestHeader('content-type','application/json');
			req.send( JSON.stringify({cmmt_id: cmmt_id.innerText, content: content.value}) );

		}




		//編輯留言按鍵處理
		if(e.target.className === 'cmmt_edit'){
			var content = e.target.parentNode.parentNode.nextElementSibling;
			var newTextArea = document.createElement('textarea');

			//顯示留言區塊轉換成textarea
			newTextArea.className = 'cmmt_textarea';
			newTextArea.innerText = content.innerText;
			content.outerHTML = newTextArea.outerHTML;
			e.target.innerText = '完成';
			e.target.className = 'cmmt_edited';

		}

	
		//刪除留言按鍵處理
		if(e.target.className === 'cmmt_delete'){

			alert('確定要刪除嗎？');
			// console.log(e.target);

			var content = e.target.parentNode.parentNode.nextElementSibling;
			var cmmt_id = content.nextElementSibling;
			// console.log(content);
			// console.log(cmmt_id);
			
			var req = new XMLHttpRequest();
			req.onreadystatechange = () => {

				if( req.status >= 200 && req.status < 400 ){

					// console.log(req.responseText);
					if(req.responseText === 'deleted') {

						window.location.reload();
					}

				}
			}

			req.open( 'POST', 'cmmt_delete.php', true );
			req.setRequestHeader('content-type','application/json');
			req.send( JSON.stringify({cmmt_id: cmmt_id.innerText}) );
		

		}

	})
})
</script>
<body>
<div class="wrapper">
	<?
	/* 連接資料庫 */
	require_once('conn.php');

	$is_login = false;
	$user_id = '';


	if(isset($_COOKIE['session_id']) && !empty($_COOKIE['session_id'])) {

		$session = "SELECT abbie_users.id FROM abbie_users LEFT JOIN abbie_certificate on abbie_users.id = abbie_certificate.user_id WHERE abbie_certificate.id = '".$_COOKIE['session_id']."'";

		$session_result = $conn->query($session);

		$session_row= $session_result->fetch_assoc();

		$is_login = true;
		$user_id = $session_row['id'];
	}
	?>

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

		$sql = "SELECT abbie_comments.*, abbie_users.nickname FROM abbie_comments left join abbie_users on abbie_comments.user_id = abbie_users.id where parent_id=0 ORDER BY time DESC";

		$result = $conn->query($sql);

		if($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {
	?>
			<!-- 留言顯示 -->
			<div class="comment">

				<!-- 主要留言 -->
				<div class="comment_top">
					<div class="nickname"><?php echo $row["nickname"]; ?></div>
					<div class="edit">
						<div class="time"><?php echo $row["time"]; ?></div>

	
					<? //如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
						if($user_id === $row['user_id']) {
					?>

							<button class="cmmt_edit">編輯</button>
							<button class="cmmt_delete">刪除</button>

					<?}
					?>

					</div>
				</div>					
				<div class="content"><?php echo htmlspecialchars($row["content"], ENT_QUOTES, 'utf-8'); ?></div>
				<div class="cmmt_id hidden"><?php echo $row["id"]; ?></div>

				<!-- 撈子留言 -->
				<?php
					$sub_sql = "SELECT abbie_comments.*, abbie_users.nickname FROM abbie_comments left join abbie_users on abbie_users.id=abbie_comments.user_id  where parent_id='".$row['id']."' ORDER BY time ASC";
					$sub_result = $conn->query($sub_sql);

					if($sub_result->num_rows > 0) {

						while( $sub_row = $sub_result->fetch_assoc()) {

							//如果是主留言者，則背景上色
							if( $sub_row['user_id'] === $row['user_id'] ) echo '<div class="sub_comment sub_comment_sameperson">';
							else echo '<div class="sub_comment">';

				?>

					<!-- 子留言 -->
						<div class="comment_top">
							<div class="nickname"><?php echo $sub_row["nickname"]; ?></div>
							<div class="edit">
								<div class="time"><?php echo $sub_row["time"]; ?></div>

								<? //如果這條留言的user_id等於當前用戶的 user_id，則顯示編輯/刪除按鈕
									if($user_id === $sub_row['user_id']) {
								?>

										<button class="cmmt_edit">編輯</button>
										<button class="cmmt_delete">刪除</button>

								<?}
								?>

							</div>
						</div>
						<div class="content"><?php echo htmlspecialchars($sub_row["content"], ENT_QUOTES, 'utf-8');; ?></div>
						<div class="cmmt_id hidden"><?php echo $sub_row["id"]; ?></div>
					</div>

				<?
						} //end of while 
					} //end of if
				?>
				<!-- 撰寫子留言表單 -->
				<div class="sub_comment">
					<span id="response">回應▾</span>
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