<?php
	require_once('./lib/tools.php');
	require_once('./lib/BoardDao.php');

	session_start_if_none();
	//$page = 전달된 값 저장
	$db = new BoardDao();
	$id = sessionVar("id");
	$name = sessionVar("name");
	$page = requestValue('page');

	if(!$id) {
		errorBack("회원 가입을 한 사람만 글을 작성할 수 있습니다.");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>글쓰기 페이지입니다.</title>
	<link rel="stylesheet" type="text/css" href="./css/board1.css">
</head>
<body>
	<div class="container">
		<form method="post" action="./lib/write.php">
			<table class="msg">
				<tr>
					<th>제목</th>
					<td><input type="text" name="title" maxlength="80" class="msg_title"></td>
					<td>
						<?php if($id == "admin") :?>
							<select name="division">
								<option>▼구분</option>
								<option value="1">공지 사항</option>
								<option value="2">뉴스/정보</option>
								<option value="3">잡담</option>
							</select>
							<?php else :?>
							<select name="division">
								<option value="3">잡담</option>
							</select>
						<?php endif ?>
					</td>
				</tr>
				<tr>
					<th class="msg-header">작성자</th>
					<td><input type="text" maxlength="20" name="writer" value="<?= $name ?>" class="msg_text" readonly style="background-color: #c6c6c6 "></td>
				</tr>
				<tr>
					<th>내용</th>
					<td><textarea name="content" wrap="virtual" rows="10" class="msg_text"></textarea></td>
				</tr>
			</table>
			<br>
			<div class="left">
				<input type="submit" value="글등록">
 				<input type="button" value="목록보기" onclick="location.href='<?= bdUrl("board.php",0,$page) ?>'">
			</div>
		</form>
	</div>
</body>
</html>