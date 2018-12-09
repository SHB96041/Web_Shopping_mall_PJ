<?php
	require_once("tools.php");

	//1. 세션 변수에서 로그인 정보를 삭제합니다.
	session_start_if_none();
	unset($_SESSION["id"]);
	unset($_SESSION["nick"]);

	//2. 세션 변수를 삭제했으면 메인페이지로 돌아가게 합니다.
	okGo("로그아웃이 완료되었습니다.","../index.php");
?>