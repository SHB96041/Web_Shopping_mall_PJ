<?php

	require_once('tools.php');
	require_once('BoardDao.php');

	$title = $_REQUEST["title"];
	$writer = $_REQUEST["writer"];
	$content = $_REQUEST["content"];
	$division = $_REQUEST["division"];

	echo $division;

	if($title && $writer && $content && $division){

			$db = new BoardDao();
			$db->insertMsg($writer, $title, $content, $division);
			goNow(bdUrl('../board.php',0,0));

	} else {
		errorBack("모든 항목을 입력해주세요.");
	}

?>