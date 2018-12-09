<?php
	require_once("./lib/tools.php");
	require_once("./lib/boardDao.php");

	session_start_if_none();
	$num = requestValue("num");
	$page = requestValue("page");

	$dao = new BoardDao();
	$row = $dao->getMsg($num);

	$id = sessionVar("id");
	$name = sessionVar("name");
	$board_nick = trim($row["writer"]);

	if ($name != $board_nick) {
		errorBack("게시글 작성자만 글을 수정할 수 있습니다.");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>글 수정 페이지</title>
	<link rel="stylesheet" type="text/css" href="./css/board1.css">
</head>
<body>
	<div class="container">
		<form method="post" action="<?= bdUrl("./lib/modify.php", $num, $page) ?>">
			<table class="msg">
				<tr>
					<th>제목</th>
					<td><input type="text" name="title" maxlength="80" value="<?= $row["title"] ?>" class="msg_title"></td>
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
					<th>작성자</th>
					<td><input type="text" name="writer" maxlength="20" value="<?= $row["writer"] ?>" class="msg_text"  readonly style="background-color: #c6c6c6 "></td>
				</tr>
				<tr>
					<th>글 내용</th>
					<td><textarea name="content" wrap="virtual" rows="10" class="msg_text"><?= $row["content"] ?></textarea></td>
				</tr>
			</table>
			<br>
			<div class="left">
				<input type="submit" value="적용">
				<input type="button" value="목록보기" onclick="location.href='<?= bdUrl("board.php",0,$page) ?>'">
			</div>
		</form>
	</div>
</body>
</html>