<?php
	require_once("./lib/tools.php");
	require_once("./lib/BoardDao.php");

	session_start_if_none(); // tools.php - 26line : 세션 변수가 있는지 확인을 하고 없으면 세션을 시작하는 함수입니다.

	$id = sessionVar("id"); // 세션값 id를 들고옵니다.

	$page = requestValue("page"); // 현재 페이지 값을 받아오는 변수입니다.

	//화면 구성 관련된 상수
	define("GALLERY_PICTURE", 12); // 한 페이지에 표시 될 갤러리의 사진 수 입니다.
	define("PAGE_LINK_NUM",10); // 화면에 표시될 페이지의 링크 수 입니다.

	//갤러리의 전체 사진 수 구하기
	$db = new BoardDao();
	$count = $db->galleryCount(); // galley 테이블에 있는 전체 컬럼 수를 가져옵니다.

	if($count > 0) {

		//전체 페이지 수 구하기
		$numPages = ceil($count/GALLERY_PICTURE);

		// 현재 페이지 번호가 (1 ~ 전체 페이지 수) 벗어나면 보정을 합니다.
		if($page < 1)
			$page = 1;
		if($page > $numPages)
			$page == $numPages;

		// 한 페이지에 보일 사진의 레코드 번호 계산
		$offset = ($page - 1) * GALLERY_PICTURE;
		$pictureList = $db->getPictureList(GALLERY_PICTURE,$offset);

		//페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
		$firstLink = floor(($page-1) / PAGE_LINK_NUM) * PAGE_LINK_NUM+1;
		$lastLink = $firstLink + PAGE_LINK_NUM - 1;

		if($lastLink > $numPages)
		$lastLink = $numPages;
	}

?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>X-BOX ONE Community - Gallery</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/gallery.css">
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
		<section class="sub_header_section">
			<h2>Gallery</h2>
			<ul class="breadcrum_list">
				<li><a href="index.php">Home /</a></li>
				<li><a href="gallery.php">Gallery</a></li>
			</ul>
		</section>
		<section class="content_section">
			<div class="content_row_1">
				<ul class="gallery_list">
					<?php foreach ($pictureList as $row): ?>
						<li><a href="#"><img src="images/g_images/<?= $row['fname'] ?>"></a></li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="content_row_2">
				<div class="search_box">
					<form action="#" method="get">
						<input type="search" name="gallery_search_window" class="search_window" placeholder="검색어">
						<div class="search_select_box">
							<span>검색 대상</span>
							<ul class="search_select_list">
								<li>제목</li>
								<li>이름</li>
								<li>닉네임</li>
								<li>아이디</li>
							</ul>
						</div>
					</form>
				</div>
				<div class="write_box">
					<a href="http://localhost/project/gallery_update_form.php">글쓰기</a>
				</div>
			</div>
			<div class="content_row_3">
				<!--<span class="list_prev_btn" onclick="location.href='?page=<?= $page-1 ?>'">갤러리 이전 버튼</span>
				<a href="?page=1">1</a>
				<a href="?page=2">2</a>
				<a href="?page=3">3</a>
				<span class="list_next_btn">갤러리 다음 버튼</span>-->
				<span class="list_prev_btn" onclick="location.href='?page=<?= $page-1 ?>'">갤러리 이전 버튼</span>
					<?php for($i = $firstLink; $i <= $lastLink; $i++) :?>
						<?php if($i == $page) :?>
							<a href="<?=bdUrl("gallery.php",0,$i) ?>"><?= $i ?></a>
						<?php else :?>
							<a href="<?= bdUrl("gallery.php", 0, $i) ?>"><?= $i ?></a>
						<?php endif ?>
					<?php endfor ?>
				<span class="list_next_btn" onclick="location.href='?page=<?= $page+1 ?>'">갤러리 다음 버튼</span>
			</div>
		</section>
		<footer class="footer">
			<p>copyright&copy; 2018. Shin Hyeonbin all rights reserved</p>
		</footer>
	</div>
</body>
</html>