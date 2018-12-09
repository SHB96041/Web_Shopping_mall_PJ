<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>회원가입 페이지</title>
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
	<div class="container">
		<p class="display-3 font-weight-bold"><a href="index.php"><img src="./images/s_images/x-box-icon.png" width="50px" height="50px"></a><font style="color: #18873d">X</font>-Box Contact <font style="color: #18873d">US</font></p>
		<hr>
		<h3>회원 정보 입력 페이지</h3>
		<p style="color: #adadad">모든 정보를 입력해주셔야 회원가입이 가능합니다.</p><br>
				<form name="member_form" method="post" action="./lib/insert_member.php" class="input_form">
					<div class="form-group">
							<label class="col-sm-2">*아이디</label>
							<input type="text" name="id" class="col-sm-3" placeholder="ID를 입력해주세요.">&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" onclick="check_id()">중복아이디 확인</button>
						<div>
							<font size="2vm" class="col-sm-2">
								<b>아이디는 4~12자의 영문 소문자, 숫자와 특수기호(_)만 사용가능합니다.</b>
							</font>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2">*비밀번호</label>
						<input type="password" name="password" class="col-sm-3" placeholder="비밀번호를 입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*비밀번호 재확인</label>
						<input type="password" name="password_check" class="col-sm-3" placeholder="비밀번호를 재입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*이름</label>
						<input type="text" name="name" class="col-sm-3" placeholder="이름을 입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*닉네임</label>
						<input type="text" name="nick" class="col-sm-3" placeholder="닉네임을 입력해주세요.">&nbsp;&nbsp;<button class="btn btn-secondary btn-sm" onclick="check_nick()">중복닉네임 확인</button><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">*휴대폰 번호</label>
						<select name="telecom" size="1">
							<option value="">SKT</option>
							<option value="">LGT</option>
							<option value="">KT</option>
						</select>
						<input type="text" name="phone" class="col-sm-3" placeholder=" -를 포함하여 입력해주세요."><br>
					</div>
					<div class="form-group">
						<label class="col-sm-2">이메일</label>
						<input type="text" name="email" class="col-sm-3" placeholder="이메일을 입력해주세요.">@
						<select name="email2" size="1">
							<option value="@naver.com">naver.com</option>
							<option value="@hanmail.com">hanmail.com</option>
							<option value="@google.com">google.com</option>
						</select>
						<!-- 미구현 -->
						<button class="btn btn-secondary btn-sm">이메일 인증</button><br>
						<div>
							<font size="2vm" color="red" class="col-sm-2">
							*는 필수 입력 항목입니다.
							</font>
						</div>
					<div class="form-group" style="text-align: center;">
						<input type="submit" value="회원가입" class="btn btn-success">
						<input type="button" value="리셋폼" onclick="reset_form()" class="btn btn-light">
					</div>
					</div>
		      <!-- 회원가입시 script 파일로 다음 페이지에 값을 넘겨주자. -->
				</form>
	</div>
</body>
</html>