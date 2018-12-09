<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<title>X-BOX ONE Community - Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/introduce.css">
	<link rel="shortcut icon" href="images/favicon/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="images/icon/flat-design-touch.png">
	<script src="js/jquery.min.js"></script>
	<script src="js/flat.min.js"></script>
	<!-- Latest compiled and minified CSS -->
</head>
<body>
	<div id="wrap">
		<section class="info_section">
			<ul class="info_list">
				<li><a href="index.php"><img src="images/s_images/info_icon_01.png" alt=""></a></li>
				<li><a href="login.php"><img src="images/s_images/info_icon_02.png" alt=""></a></li>
				<li><a href="member_form.php"><img src="images/s_images/info_icon_03.png" alt=""></a></li>
				<li><a href=""><img src="images/s_images/info_icon_04.png" alt=""></a></li>
			</ul>
		</section>
		<header class="header">
			<h1 class="logo">
				<a href="index.php"><img src="./images/s_images/x-box-icon.png" width="50px" height="50px"><br>X-BOX<br>Community</a>
			</h1>
			<nav class="nav">
				<ul class="gnb">
					<li><a href="index.php">HOME</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="introduce.php">What's X-Box ?</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="gallery.php">Gallery</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="board.php">Board</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="chat/index.html">Chatting</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
				</ul>
			</nav>
			<span class="menu_toggle_btn">전체 메뉴 토글 버튼</span>
		</header>
		<section class="sub_header_section">
			<h2>Login Page</h2>
			<ul class="breadcrum_list">
				<li><a href="index.php">HOME</a></li>
			</ul>
		</section>
        <section class="content_section">
			<div class="content_row_1">
			<div>
				<font size="6em"><font style="color: #18873d">X</font>-Box Login <font style="color: #18873d">Page</font></font>
			</div>
			<div>
				<form name="login_form" action="./lib/login_check.php" method="post">
					<label>ID : </label><br>
						<input type="text" name="id" size="15" placeholder="Input Your ID"><br>
					<label>Password : </label><br>
						<input type="password" name="pw" size="15" placeholder="Input Your Password"><br>
					<input type="submit" value="submit">
				</form>
			</div>
			</div>
		</section>
		<footer class="footer">
			<p>copyright&copy; 2018. Shin Hyeonbin all rights reserved</p>
		</footer>
	</div>
</body>
</html>