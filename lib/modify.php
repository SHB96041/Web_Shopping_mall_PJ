<?php
	session_start();
	require_once("./tools.php");
	require_once("./BoardDao.php");

	$db = new BoardDao();

	$num = requestValue("num");
	$page = requestValue("page");

	$title = requestValue("title");
	$writer = requestValue("writer");
	$content = requestValue("content");
	$division = requestValue("division");

	$id = sessionVar("id");

	if($title && $writer && $content){
		$db->updateMsg($num, $writer, $title, $content, $division);
		okGo("글 수정이 완료되었습니다",bdUrl("../board.php",0,$page));
	} else {
		errorBack("모든 항목을 입력해주세요.");
	}
?>