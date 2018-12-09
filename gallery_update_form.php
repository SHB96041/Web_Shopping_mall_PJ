<?php
	require_once("./lib/BoardDao.php");
	require_once("./lib/tools.php");

	$dao = new BoardDao();
	session_start_if_none();

	$id = sessionVar("id");

	if(!$id) { // 로그인이 되지 않은 사용자는 사진을 올릴 수 없게 합니다.
		errorBack("로그인 한 사용자만 사진을 올릴 수 있습니다.");
	}

	$sort = isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "fname";
	$dir = isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "asc";

	$result = $dao->getFileList($sort, $dir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>글 쓰기 - 갤러리</title>
	<style type="text/css">
		table { width: 700px; text-align: center; }
		th { background-color: cyan; }

		.left { text-align: left; }
		.right { text-align: right; }
		a:link { text-decoration: none; color: blue; }
		a:hover { text-decoration: none; color: red; }
	</style>
</head>
<body>
	<!-- ?sort=<?= $sort ?>&dir=<?= $dir ?> 27행의 galley_update.php뒤에 작성할 것 -->
	<form action="./lib/gallery_update.php" method="post" enctype="multipart/form-data">
		업로드할 파일을 선택하세요.<br>
		<input type="file" name="upload"><br>
		<input type="submit" value="업로드">
		<br>
	</form>
	<table>
		<tr>
			<th>파일명
				<a href="?sort=fname&dir=asc">^</a>
				<a href="?sort=fname&dir=desc">v</a>
			</th>
			<th>업로드
				<a href="?sort=ftime&dir=asc">^</a>
				<a href="?sort=ftime&dir=asc">v</a>
			</th>
			<th>크기</th>
			<th>삭제</th>
		</tr>
		<?php foreach ($result as $row) : ?>
			<tr>
				<td class="left"><a href="./files/<?= $row["fname"] ?>"><?= $row["fname"] ?></a></td> <!-- 수정 요구 -->
				<td><?= $row["ftime"] ?></td>
				<td class="right"><?= $row["fsize"] ?>&nbsp;&nbsp;</td>
				<td><a href="lib/gallery_delete.php?id=<?= $row["id"] ?>&fname=<?= $row["fname"] ?>">x</a></td> <!-- 수정 요구 -->
			</tr>
		<?php endforeach ?>
	</table>
</body>
</html>