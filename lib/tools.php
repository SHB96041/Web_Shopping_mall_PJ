<?php

	define("MAIN_PAGE", "index.html");
	// 게시판 모듈의 URL을 반환하는 함수입니다.
	function bdUrl($file, $num, $page){ // Ex) Filename : view.php  $num = 1 $page = 5
		$join = "?";
		if($num){
			$file .= $join . "num=$num"; // $file = "view.php?num=1"
			$join = "&";
		}
		if($page)
			$file .= $join . "page=$page"; // file \ "view.php?num=1 page="

		return $file;
	}

	function sessionVar($name) { // 세션값이 있는지를 확인하고 있는 경우에는 세션 변수를 생성하고 저장합니다.
		return isset($_SESSION[$name]) ? $_SESSION[$name] : "";
	}

	// GET/POST로 전달된 값을 읽어 반환하는 함수 해당 값이 정의되지 않았으면 빈 문자열을 반환합니다.
	function requestValue($name){
		return isset($_REQUEST[$name]) ? $_REQUEST[$name] : "";
	}

	function session_start_if_none(){ // 세션 변수가 있는지 확인하고 세션변수가 없으면 세션을 시작합니다.
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	//지시된 URL로 이동하는 함수입니다.
	function goNow($url){
		header("Location: $url");
		exit();
	}

	//에러가 발생할 경우 해당 메시지를 보여주고 이전 페이지로 돌아갑니다.
	function errorBack($msg){
?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<script type="text/javascript">
			alert('<?= $msg ?>');
			history.back();
		</script>
	</body>
	</html>
	<?php
		exit();
	}

	//경고창에 지정된 메시지를 출력하고 지정된 페이지로 돌아가는 함수입니다.
	function okGo($msg, $url){
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<script type="text/javascript">
			alert('<?= $msg ?>');
			location.href='<?= $url ?>';
		</script>
	</body>
	</html>
	<?php
		exit();
		}

	?>
