<?php
	require_once("./lib/tools.php");
	require_once("./lib/BoardDao.php");
	session_start_if_none();

	$db = new BoardDao();
	$id = sessionVar("id");
	$name = sessionVar("nick");

	$lastwriter = $db->getManyMsgs(5,0);
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>X-BOX ONE Community</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="shortcut icon" href="images/favicon/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="images/icon/flat-design-touch.png">
<script src="js/jquery.min.js"></script>
<script src="js/flat.min.js"></script>
</head>
<body>
	<div id="wrap">
		<section class="info_section">
			<?php if($id) :?>
				<ul class="info_list">
					<li><a href="index.php"><img src="images/s_images/info_icon_01.png" alt=""></a></li>
					<li><a href="./lib/logout.php"><img src="images/s_images/info_icon_05.png" alt=""></a></li>
					<li><a href="member_update_form.php"><img src="images/s_images/info_icon_03.png" alt=""></a></li>
					<li><a href=""><img src="images/s_images/info_icon_04.png" alt=""></a></li>
				</ul>
			<?php else :?><!-- 로그인 하지 않은 경우 -->
				<ul class="info_list">
					<li><a href="index.php"><img src="images/s_images/info_icon_01.png" alt=""></a></li>
					<li><a href="login.php"><img src="images/s_images/info_icon_02.png" alt=""></a></li>
					<li><a href="member_form.php"><img src="images/s_images/info_icon_03.png" alt=""></a></li>
					<li><a href=""><img src="images/s_images/info_icon_04.png" alt=""></a></li>
				</ul>
			<?php endif ?>
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
		<section class="slider_section">
			<span class="prev_btn">이전 버튼</span><span class="next_btn">다음 버튼</span>
		</section>
		<section class="latest_post_section">
			<h2 class="title">최근 글</h2>
			<ul class="latest_post_list">
				<?php foreach ($lastwriter as $row) :?>
					<li><a href="<?= bdUrl('view.php',$row["num"], 1) ?>"><?= $row["title"] ?></a></li>
				<?php endforeach ?>
			</ul>
		</section>
		<section class="popular_post_section">
			<h2 class="title">인기 글</h2>
			<ul class="popular_post_list">
			</ul>
		</section>
		<section class="gallery_section">
			<ul class="gallery_list">
				<li>
					<a href="#">
						<figure>
							<img src="images/p_images/gallery_01.jpg" alt="">
							<figcaption>Play Game</figcaption>
						</figure>
					</a>
				</li>
				<li>
					<a href="#">
						<figure>
						<img src="images/p_images/gallery_02.jpg" alt="">
						<figcaption>Community</figcaption>
						</figure>
					</a>
				</li>
			</ul>
		</section>
		<section class="rankup_section">
			<h2 class="title">XBOX GAME RANKINGS</h2>
			<ul class="rankup_list">
				<li><a href="">Halo 2</a></li>
				<li><a href="">Halo : Combat Evolved</a></li>
				<li><a href="">Tom Clancy's Splinter Cell</a></li>
				<li><a href="">The Elder Scrolls III</a></li>
				<li><a href="">Fable</a></li>
				<li><a href="">Grand Theft Auto III</a></li>
				<li><a href="">Need for Speed Underground 2</a></li>
				<li><a href="">Star Wars : KotOR</a></li>
				<li><a href="">Project GOtham Racing</a></li>
				<li><a href="">Grand Theft Auto: san Andreas</a></li>
			</ul>
		</section>
		<section class="banner_section">
			<div class="banner_box_01">
				<a href=""><img src="images/s_images/x_box_logo.png" alt=""></a>
			</div>
			<div class="banner_box_02">
				<ul class="banner_list">
					<li><a href=""><img src="images/s_images/js_logo.png" alt=""></a></li>
					<li><a href=""><img src="images/s_images/html_logo.png" alt=""></a></li>
					<li><a href=""><img src="images/s_images/css_logo.png" alt=""></a></li>
				</ul>
			</div>
		</section>
		<section class="social_section">
			<ul class="social_list">
				<li><a href="https://twitter.com/login?lang=ko"><img src="images/s_images/social_icon_01.png" alt=""></a></li>
				<li><a href="https://ko-kr.facebook.com/login/"><img src="images/s_images/social_icon_02.png" alt=""></a></li>
				<li><a href="https://accounts.google.com/Login?hl=ko"><img src="images/s_images/social_icon_03.png" alt=""></a></li>
			</ul>
		</section>
		<footer class="footer">
			<p>copyright&copy; 2018. Shin Hyeonbin all rights reserved</p>
		</footer>
	</div>
</body>
</html>