<?php
	// 아이디가 중복인지를 확인하는 페이지입니다.
	require_once("./lib/BoardDao.php");
	$db = new BoardDao();
	$id = $_REQUEST["id"];
	$checkId = $db->checkId($id);

	if ($checkId) {
		echo "<b>$id</b> 는 이미 존재하는 아이디입니다.<br>";
		echo "다른 아이디를 사용해 주십시오.";
	} else {
		echo "사용 가능한 아이디입니다.";
	}

?>