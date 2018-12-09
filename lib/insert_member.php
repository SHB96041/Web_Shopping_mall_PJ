<?php
	require_once("Dao.php");
	require_once("tools.php");

	$user_id = $_REQUEST["id"]; // 사용자 아이디
	$user_pw = $_REQUEST["password"]; // 사용자 비밀번호
	$user_name = $_REQUEST["name"]; // 사용자 이름
	$user_nick = $_REQUEST["nick"]; // 사용자 닉네임
	$user_phone = $_REQUEST["phone"]; // 사용자 휴대폰번호
	$user_email = $_REQUEST["email"].$_REQUEST["email2"]; // 사용자 이메일
	$regist_day = date("Y-m-d(H:i)"); // 가입일자 및 시간

	$db = new Dao(); // 데이터베이스 객체
	$info_check = $db->getMember($user_id); // 회원 가입을 하려는 user의 모든 정보를 저장하는 변수입니다.
	$nick_check = $db->nickCheck($user_nick);
	// 1. 사용자로 부터 필수적입 입력항목들을 받았는지에 대해 확인을 한다.
	if ($user_id && $user_pw && $user_pw && $user_name && $user_nick && $user_phone) {
		if ($info_check) {
			errorBack("이미 사용중인 아이디입니다.");
		} else if ($nick_check) {
			errorBack("이미 사용중인 닉네임입니다.");
		} else {
		 	$db->insertMember($user_id, $user_pw, $user_name, $user_nick, $user_phone, $user_email, $regist_day);
		 	okGo("회원가입이 완료되었습니다.","../");
		}
	} else {
		errorBack("빈 칸의 모든 항목들을 입력해주세요.");
	}
	// if($user_id == $info_check['id']){
	// 	errorBack("해당 아이디는 이미 사용중입니다.");
	// } else if ($user_nick == $nick_check['nick']) {
	// 	errorBack("해당 닉네임은 이미 사용중입니다.");
	// } else {
	 //	$db->insertMember($user_id, $user_pw, $user_name, $user_nick, $user_phone, $user_email, $regist_day);
	// 	okGo("회원가입이 완료되었습니다.","../");
	// }

?>