<?php
	session_start();

	require_once("./tools.php");
	require_once("./BoardDao.php");

	$db = new BoardDao();
	$num = requestValue("num"); // 게시글 번호입니다.
	$row = $db->getMsg($num);

	$name = sessionVar("name"); // 현재 로그인한 사용자의 닉네임을 가져옵니다.
	$board_name = trim($row["writer"]); // 게시글 작성자의 닉네임을 가져옵니다.

	if($name == $board_name){
		$db->deleteMsg($num);
		okGo("글 삭제가 완료되었습니다.","../board.php");
	} else{
		errorBack("게시글 작성자 본인만 삭제할 수 있습니다.");
	}

?>