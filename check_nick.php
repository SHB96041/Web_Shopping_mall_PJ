<?php
	// 아이디가 중복인지를 확인하는 페이지입니다.

	require_once("./lib/BoardDao.php");
	$db = new BoardDao();

	$nick = $_REQUEST["nick"];
	$checkNick = $db->checkNick($nick);

	if ($checkNick) {
		echo "<b>$nick</b> 는 이미 존재하는 닉네임입니다.<br>";
		echo "다른 닉네임을 사용해 주십시오.";
	} else {
		echo "사용 가능한 닉네임입니다.";
	}

?>