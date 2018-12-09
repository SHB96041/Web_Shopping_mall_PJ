<?php

	require_once("Dao.php");
	require_once('tools.php');

	$db = new Dao();
	$user_id = requestValue("id"); // Form으로 부터 받은 사용자의 아이디입니다.
	$user_pw = requestValue("pw"); // Form으로 부터 받은 사용자의 비밀번호입니다.

	$info_check = $db->getMember($user_id); // 사용자로 부터 받은 아이디에 대한 모든 정보를 info_check에 담고있습니다.

	if ($user_id == $info_check["id"] && $user_pw == $info_check["pass"]) {
		session_start_if_none();
		$_SESSION["id"] = $user_id;
		$_SESSION["name"] = $info_check["name"];
		okGo("로그인에 성공하셨습니다.","../");
	} else {
		errorBack("아이디 또는 비밀번호가 틀렸습니다.");
	}

?>