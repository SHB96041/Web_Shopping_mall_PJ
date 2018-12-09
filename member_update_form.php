<?php
	require_once("./lib/tools.php");
	require_once("./lib/Dao.php");


	// 현재 로그인 되어 있는 사용자의 정보를 읽어야 합니다.
	session_start_if_none();

	$db = new Dao();
	$member = $db->getmember($_SESSION["id"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>회원정보 수정 페이지</title>
	<!-- 회원가입폼에 적용한 자바스크립트 입니다. -->
  	<script src="js/memberform.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			background-image: url('./images/s_images/body_bg.png');
		}
		body > div {
			background-color: #ffffff;
			height: 750px;
		}
	</style>
</head>
<body>
	 <!--
	 수정이 불가능한 정보 : id(사용자 ID), regist_day(가입일), name(이름)

	 수정이 가능한 정보 : pass(패스워드), nick(닉네임), phone(휴대폰 번호), email(이메일)
  	-->
	<div class="container">
		<span class="h1 font-weight-bold"><font style="color: #18873d">회원정보</font>수정 페이지</span>
		<hr>
		<span><font class="h4"><font style="color: #18873d">회원</font> 정보 변경</font>
		<font class="h6">| 고객님의 회원정보를 수정하실 수 있습니다. 회원정보를 변경하시고 반드시 하단에 있는 <b>확인</b> 버튼을 클릭해 주셔야 합니다.</font>
		</span>
		<p style="color: #adadad">*표시된 모든 정보를 입력해주셔야 회원 정보 수정이 가능합니다.</p><br>
				<form name="member_form" method="post" action="./lib/member_update.php" class="input_form">
					<div class="form-group">
							<label class="col-sm-2">이름</label>
							<span><?= $member["name"] ?></span>
					</div>
					<div class="form-group">
							<label class="col-sm-2">회원 가입일</label>
							<span><?= $member["regist_day"] ?></span>
					</div>
					<div class="form-group">
							<label class="col-sm-2">아이디</label>
							<span><?= $member["id"] ?></span>
					</div>
					<div class="form-group ">
						<label class="col-sm-2">*비밀번호</label>
						<input type="password" name="u_pw" class="col-sm-3" placeholder="비밀번호를 입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*비밀번호 재확인</label>
						<input type="password" name="u_pwc" class="col-sm-3" placeholder="비밀번호를 재입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*닉네임</label>
						<input type="text" name="u_nick" class="col-sm-3" placeholder="닉네임을 입력해주세요.">&nbsp;&nbsp;<button class="btn btn-secondary btn-sm">중복닉네임 확인</button>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*휴대폰 번호</label>
						<select name="telecom" size="1">
							<option value="">SKT</option>
							<option value="">LGT</option>
							<option value="">KT</option>
						</select>
						<input type="text" name="u_phone" class="col-sm-3" placeholder=" -를 포함하여 입력해주세요.">&nbsp;&nbsp;<button class="btn btn-secondary btn-sm">휴대폰 인증</button>
					</div>
					<div class="form-group">
						<label class="col-sm-2">이메일</label>
						<input type="text" name="u_email1" class="col-sm-3" placeholder="이메일을 입력해주세요.">@
						<select name="u_email2" size="1">
							<option value="@naver.com">naver.com</option>
							<option value="@hanmail.com">hanmail.com</option>
							<option value="@google.com">google.com</option>
						</select>
					<div class="form-group" style="text-align: center; margin-top: 30px;">
						<input type="submit" value="확인" class="btn btn-success">
						<input type="button" value="리셋폼" onclick="reset_form()" class="btn btn-light">
						<input type="button" value="메인 페이지" class="btn btn-success" onclick="location.href='index.php'">
					</div>
					</div>
		     		 <input type="hidden" name="u_id" value="<?= $member["id"] ?>">
				</form>
	</div>
</body>
</html>