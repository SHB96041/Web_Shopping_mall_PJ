<?php
	require_once("tools.php");
	require_once("BoardDao.php");

	$db = new BoardDao();
	$id = $_REQUEST["id"]; // gallery_update_form의 session에서 아이디값을 가져옵니다.
	$fname = $_REQUEST["fname"]; // session_update_form에서 파일 이름을 가져옵니다.

	$db->delefeFileInfo($id, $fname);
	unlink("../images/g_images/$fname"); // 데이터 베이스의 사진 정보를 삭제함과 동시에 서버의 파일도 삭제합니다.

	okGo("사진이 삭제되었습니다.", "../gallery_update_form.php");
?>