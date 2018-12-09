<?php

	require_once("./lib/tools.php");
	require_once("./lib/BoardDao.php");
	session_start_if_none();

	// 전달된 값 저장
	$num = requestValue("num");
	$page = requestValue("page");
	$name = sessionVar("name");

	// 지정된 번호의 글 데이터를 읽고 조회수를 증가시킵니다.
	$dao = new BoardDao();
	$row = $dao->getMsg($num);
	$dao->increaseHits($num);
?>

<!DOCTYPE html>
<html lang="kr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/board1.css">
	<title>글 내용 보기 페이지</title>
</head>
<body>
	<div class="container">
		<table class="msg">
			<tr>
				<th class="msg-header">제목</th>
				<td class="msg-text left"><?= $row["title"]; ?></td>
			</tr>
			<tr>
				<th>작성자</th>
				<td class="msg-text left"><?= $row["writer"]; ?></td>
			</tr>
			<tr>
				<th>작성일시</th>
				<td class="msg-text left"><?= $row["regtime"]; ?></td>
			</tr>
			<tr>
				<th>조회수</th>
				<td class="msg-text left"><?= $row["hits"]; ?></td>
			</tr>
			<tr>
				<th>내용</th>
				<td class="msg-text left"><?= $row["content"]; ?></td>
			</tr>
		</table>
		<br>
		<?php if($name == trim($row["writer"])) :?>
			<div>
				<input type="button" value="목록보기" onclick="location.href='<?= bdUrl("board.php", 0, $page) ?>'">
				<input type="button" value="수정" onclick="location.href='<?= bdUrl("modify_form.php", $num, $page) ?>'">
				<input type="button" value="삭제" onclick="location.href='<?= bdUrl("./lib/delete.php", $num, $page) ?>'">
			</div>
		<?php else :?>
			<div>
				<input type="button" value="목록보기" onclick="location.href='<?= bdUrl("board.php", 0, $page) ?>'">
			</div>
		<?php endif ?>
	</div>
</body>
</html>