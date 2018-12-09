<?php
	require_once("./lib/tools.php");

	session_start_if_none();
	$id = sessionVar("id");
	$pw = sessionVar("pw");
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>X-BOX ONE Community - What's X-Box ?</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/introduce.css">
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
					<li><a href="introuduce.php">What's X-Box ?</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="gallery.php">Gallery</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="board.php">Board</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
					<li><a href="chat/index.html">Chatting</a><span class="sub_menu_toggle_btn">하위 메뉴 토글 버튼</span></li>
				</ul>
			</nav>
			<span class="menu_toggle_btn">전체 메뉴 토글 버튼</span>
		</header>
		<section class="sub_header_section">
			<h2>What's X-Box ?</h2>
			<ul class="breadcrum_list">
				<li><a href="index.php">HOME /</a></li>
				<li><a href="introduce.php">What's X-BOX</a></li>
			</ul>
		</section>
        <section class="content_section">
			<div class="content_row_1">
				<img src="images/s_images/xbox_one.jpg" alt="">
				<h3>X - BOX</h3>
				<p>1995년, 미국 마이크로소프트(Microsoft)가 신형 운영체제인 ‘윈도우 95’를 출시해 큰 인기를 얻으면서 PC(개인용컴퓨터) 시장의 주도권은 완전히 마이크로소프트의 손에 놓이게 되었다. 운영체제 시장을 지배하게 되면 이에 대응하는 각종 하드웨어나 응용프로그램에도 막대한 영향력을 끼치게 된다.마이크로소프트가 윈도우 시리즈를 출시하면서 크게 신경 쓴 것이 바로 멀티미디어, 그 중에서도 게임이었다. 특히 윈도우 이전의 운영체제인 도스(Dos)에서 게임을 개발하거나 즐기는 것에 어려움이 많았다는 것을 참고해 마이크로소프트는 윈도우 게임 개발자를 위한 공용 개발 인터페이스인 다이렉트X(DirectX)를 내놓았다. 다이렉트X의 등장 이후 윈도우 기반 PC 게임들의 품질이나 호환성, 안정성이 크게 향상되었으며, 덩달아 PC로 게임을 즐기는 인구도 크게 늘어나게 된다.</p>
			</div>
		</section>
		<footer class="footer">
			<p>copyright&copy; 2018. Shin Hyeonbin all rights reserved</p>
		</footer>
	</div>
</body>
</html>