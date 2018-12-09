<?php
	require_once("./lib/tools.php");
	require_once("./lib/BoardDao.php");

	session_start_if_none();

	$id = sessionVar("id");
	$pw = sessionVar("pw");

	//전달된 페이지 번호 저장
	$page = requestValue("page");

	//화면 구성에 관련된 상수 정의
	define("NUM_LINES", 5); //게시글 리스트의 줄 수
	define("NUM_PAGE_LINKS", 10); // 화면에 표시될 페이지 링크 수

	//게시판의 전체 게시글 수 구하기
	$dao = new BoardDao();
	$numMsgs = $dao->getNumMsgs();

	$offset = 0;

	if($numMsgs > 0){
		//전체 페이지 수 구하기
		$numPages = ceil($numMsgs / NUM_LINES); // ceil() : 올림을 하는 함수입니다. $numPages = 2
		//현재 페이지 번호가 (1~ 전체 페이지 수)를 벗어나면 보정을 합니다.
		if($page < 1)
			$page = 1;
		if($page > $numPages)
			$page = $numPages;

		//리스트에 보일 게시글 데이터 읽기
		if ($page > 1) {
			for ($i=1; $i < $page ; $i++) {
				$offset += 5;
			}
		}
		$msgs = $dao->getManyMsgs(NUM_LINES, $offset); // 일반 게시글들을 불러오는 함수 입니다.
		$noticeMsgs = $dao->getNoticeMsgs(); // 공지사항과 뉴스 게시글을 불러오는 함수 입니다.

		// 페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
		$firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1; //floor : 버림을 하는 함수입니다.
		$lastLink = $firstLink + NUM_PAGE_LINKS - 1;
		if($lastLink > $numPages)
			$lastLink = $numPages;
	}
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<title>X-BOX ONE Community - board</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/board.css">
<link rel="shortcut icon" href="images/favicon/favicon.ico">
<link rel="apple-touch-icon-precomposed" href="images/icon/flat-design-touch.png">
<script src="js/jquery.min.js"></script>
<script src="js/flat.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
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
			<h2>Board</h2>
			<ul class="breadcrum_list">
				<li><a href="index.php">Home /</a></li>
				<li><a href="board.php">Board</a></li>
			</ul>
		</section>
		<section class="content_section">
			<div class="content_row_1">
				<table class="board_table">
			<caption>Board</caption>
 				<?php if ($numMsgs > 0) :?>
					<table class="board_table">
						<thead>
							<tr>
								<th>번호</th>
								<th>제목</th>
								<th>작성자</th>
								<th>작성일시</th>
								<th>조회수</th>
							</tr>
						</thead>
						<tbody>
								<!-- 공지사항 부분 입니다.  -->
								<?php foreach($noticeMsgs as $row) :?>
									<tr>
									<td><?= $row["num"] ?></td>
									<td><a href="<?= bdUrl("view.php", $row["num"], $page) ?>"><?= $dao->category($row["division"],$row["title"]) ?></a></td>
									<td><?= $row["writer"] ?></td>
									<td><?= $row["regtime"] ?></td>
									<td><?= $row["hits"] ?></td>
									</tr>
								<?php endforeach ?>
								<!-- 일반 게시판 영역 입니다. -->
								<?php foreach($msgs as $row) :?>
									<tr>
									<td><?= $row["num"] ?></td>
									<td><a href="<?= bdUrl("view.php", $row["num"], $page) ?>"><?= $row["title"] ?></a></td>
									<td><?= $row["writer"] ?></td>
									<td><?= $row["regtime"] ?></td>
									<td><?= $row["hits"] ?></td>
									</tr>
								<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
			<div class="content_row_2">
				<div class="search_box">
					<form action="./lib/boardsearch.php" method="get" name="search_form">
						<input type="search" name="search" class="search_window" placeholder="검색어">
						<div class="search_select_box">
							<span id="search_object">검색 대상</span>
							<ul class="search_select_list">
								<li onclick="search('num')" name="nick">게시글 번호</li>
								<li onclick="search('title')" name="title">제목</li>
								<li onclick="search('writer')" name="name">작성자</li>
							</ul>
							<input type="hidden" name="object">
						</div>
					</form>
				</div>
				<div class="write_box">
					<a href="./write_form.php">글 쓰기</a>
				</div>
			</div>
			<div class="content_row_3">
			<?php if($numMsgs > 0) :?>
				<span class="list_prev_btn" onclick="location.href='?page=<?= $page-1 ?>'" ></span>
					<?php for($i = $firstLink; $i <= $lastLink; $i++) :?>
						<?php if($i == $page) :?>
							<a href="<?=bdUrl("board.php",0,$i) ?>"><?= $i ?></a>
						<?php else :?>
							<a href="<?= bdUrl("board.php", 0, $i) ?>"><?= $i ?></a>
						<?php endif ?>
					<?php endfor ?>
				<span class="list_next_btn" onclick="location.href='?page=<?= $page+1 ?>'"><a href=""></a></span>
			<?php endif ?>
			</div>
		</section>
		<footer class="footer">
			<p>copyright&copy; 2018. Shin Hyeonbin all rights reserved</p>
		</footer>
	</div>
</body>
</html>