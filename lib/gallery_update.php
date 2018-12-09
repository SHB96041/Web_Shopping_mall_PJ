<?php
	require_once("tools.php");
	session_start_if_none();

	$errMsg = "파일 업로드에 실패했습니다.";

	if($_FILES["upload"]["error"] == UPLOAD_ERR_OK) {
		$id = sessionVar("id"); // 세션에서 사용자의 아이디를 가져옵니다.
		$temp_name = $_FILES["upload"]["tmp_name"]; // 임시 폴더에 업로드된 파일의 임시 파일명 입니다.
		$file_name = $_FILES["upload"]["name"];
		$file_size = $_FILES["upload"]["size"];

		$save_name = iconv("UTF-8", "CP949", $file_name);

		if(file_exists("../images/g_images/$save_name"))
			$errMsg = "이미 업로드한 파일이 있습니다.";
		else if(move_uploaded_file($temp_name, "../images/g_images/$save_name")) {
			require_once("BoardDao.php");
			$db = new BoardDao();
			$db->addFileInfo($id,$file_name,date("Y-m-d H:i:s"),$file_size);

			/*?sort=$_REQUEST[sort]"."&dir=$_REQUEST[dir]" 30번행의 php 이후에 작성할 것*/
			header("Location: ../gallery_update_form.php");

			exit();
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<script type="text/javascript">
		alert('<?= $errMsg ?>');
		history.back();
	</script>
</body>
</html>