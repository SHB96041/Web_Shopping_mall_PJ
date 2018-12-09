<?php
	require_once("tools.php");
	require_once("Dao.php");

	$db = new Dao();
	$id = $_REQUEST["u_id"];
	$password = $_REQUEST["u_pw"];
	$password_check = $_REQUEST["u_pwc"];
	$nick = $_REQUEST["u_nick"];
	$phone = $_REQUEST["u_phone"];
	$email = $_REQUEST["u_email1"].$_REQUEST["u_email2"];

	$member = $db->getMember($id); // 회원에 대산 정보를 불러옵니다.
	$nick_check = $db->nickCheck($nick); // 중복되는 닉네임을 체크하기 위해 불러옵니다.
	if ($password && $password_check && $nick && $phone && $email) {
		 if ($password == $password_check) {
		 		if ($nick != $nick_check["nick"]) { // 닉네임 오류를 체크해야합니다.
		 			$db->updateMember($id, $password, $nick, $phone, $email);
		 			okGo("회원정보 수정이 완료되었습니다.","../index.php");
		 		} else {
		 			errorBack("중복되는 닉네임이 있습니다.");
		 		}
	 		}
	 		else
	 			errorBack("비밀번호가 일치하지 않습니다.");
	} else {
		errorBack("빈 칸 없이 모든 항목을 입력해주세요.");
	}
?>