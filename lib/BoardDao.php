<?php

	class BoardDao {
		private $db;

		public function __construct(){
			try{
				$this->db = new PDO("pgsql:dbname=termproject;host=localhost",'postgres','password');
				$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				//echo "데이터베이스 드라이버가 생성되었습니다.";
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		// 게시판의 전체 글 수(전체 레코드 수)를 반환하는 메소드입니다.
		public function getNumMsgs(){
			try{

				$query = $this->db->prepare("select count(*) from board");

				$query->execute();

				$numMsgs = $query->fetchColumn();

			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $numMsgs;
		}

		// $num 번 째 게시글 데이터를 반환하는 메소드입니다.
		public function getMsg($num){
			try{
				$query = $this->db->prepare("select * from board where num=:num");
				$query->bindValue(":num",$num,PDO::PARAM_INT);
				$query->execute();

				$msg = $query->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $msg;
		}

		//게시판에서 게시글을 검색하기 위한 메소드입니다.
		public function search($search, $searchObject){
			try{
				$query = $this->db->prepare("select * from board where :search =:searchObject");

				$query->bindValue(":search", $search, PDO::PARAM_STR);
				$query->bindValue(":searchObject", $search, PDO::PARAM_STR);

				$query->execute();
				$msg = $query->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
				return $msg;
		}

	// $start 번 부터 $row 개의 게시글 데이터를 반환합니다(2차원 배열)
	public function getManyMsgs($start, $offset){ // start : 게시글의 행수, 게시글을 나타내는 번호
		try{
			// Limit 및 Offset은 postgresql 문법을 잘 살펴보기.
			$query = $this->db->prepare("select * from board order by num desc limit :start offset :offset");
			/*게시글을 나타내는 방법
			1. offset을 5씩 증가시킨다.
			2. 끝에 게시글이 5이거나 할 경우 return을 한다.
			*/
			$query->bindValue(':start', $start,PDO::PARAM_INT);
			$query->bindValue(':offset',$offset,PDO::PARAM_INT);

			$query->execute();

			$msgs = $query->fetchAll(PDO::FETCH_ASSOC);

		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msgs;
	}

	public function checkId($id){ // 중복되는 아이디가 있는지 확인을 합니다.
		try{
			$query = $this->db->prepare("select id from member where id = :id;");

			$query->bindValue(":id",$id,PDO::PARAM_STR);

			$query->execute();

			$result = $query->fetchColumn();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $result;
	}

	public function checkNick($nick){ // 중복되는 아이디가 있는지 확인을 합니다.
		try{
			$query = $this->db->prepare("select nick from member where nick = :nick;");

			$query->bindValue(":nick",$nick,PDO::PARAM_STR);

			$query->execute();

			$result = $query->fetchColumn();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $result;
	}


	public function getPictureList($start, $offset){ // gallery 테이블에서 사진 리스트를 가져오는 함수 입니다.
		try{
			$query = $this->db->prepare("select * from gallery order by ftime desc limit :start offset :offset");
			/*게시글을 나타내는 방법
			1. offset을 5씩 증가시킨다.
			2. 끝에 게시글이 5이거나 할 경우 return을 한다.
			*/
			$query->bindValue(':start', $start,PDO::PARAM_INT);
			$query->bindValue(':offset',$offset,PDO::PARAM_INT);

			$query->execute();

			$msgs = $query->fetchAll(PDO::FETCH_ASSOC);

		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msgs;
	}


	public function getNoticeMsgs(){ // start : 게시글의 행수, 게시글을 나타내는 번호
		try{
			$query = $this->db->prepare("select * from board where division <= 2 order by division asc, regtime desc;");

			$query->execute();

			$msgs = $query->fetchAll(PDO::FETCH_ASSOC);

		}catch(PDOException $e){
			exit($e->getMessage());
		}
		return $msgs;
	}

	public function category($category, $title){ // 공지사항 앞에 어떤 글인지 분류하여 앞에 범주를 넣는 함수입니다.
		$result = "";
		switch ($category) {
			case 1:
				$result = "[공지사항] ";
				$result .= $title;
			break;
			case 2:
				$result = "[뉴스/정보] ";
				$result .= $title;
			break;

		}
		return $result;
	}

	// 새 글을 데이터베이스에 저장하는 메소드입니다.
	public function insertMsg($writer, $title, $content, $division){
		try{
			$query = $this->db->prepare("insert into board(writer, title, content, regtime, division) values (:writer , :title, :content, :regtime, :division);");

			$regtime = date("Y-m-d H:i:s");

			$query->bindValue(':writer',$writer,PDO::PARAM_INT);
			$query->bindValue(':title', $title, PDO::PARAM_STR);
			$query->bindValue(':content', $content, PDO::PARAM_STR);
			$query->bindValue(':regtime', $regtime, PDO::PARAM_STR);
			$query->bindValue(':division', $division, PDO::PARAM_INT);

			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	//게시글을 업데이터 하는 메소드입니다.
	public function updateMsg($num, $writer, $title, $content, $division){
		try{
			$query = $this->db->prepare('update board set writer=:writer, title=:title, content=:content, regtime=:regtime, division=:division where num=:num');
			$regtime = date("Y-m-d H:i:s");

			$query->bindValue(':writer', $writer, PDO::PARAM_STR);
			$query->bindValue(':title', $title, PDO::PARAM_STR);
			$query->bindValue(':content', $content, PDO::PARAM_STR);
			$query->bindValue(':regtime', $regtime, PDO::PARAM_STR);
			$query->bindValue(':division', $division, PDO::PARAM_INT);
			$query->bindValue(':num', $num, PDO::PARAM_INT);

			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	//게시글을 삭제하는 메소드입니다.
	public function deleteMsg($num) {
		try{
			$query = $this->db->prepare('delete from board where num=:num');

			$query->bindValue(':num', $num, PDO::PARAM_INT);

			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

	//게시글을 조회하면 조회수 1을 증가시키는 메소드입니다.
	public function increaseHits($num){
		try{
			$query = $this->db->prepare('update board set hits=hits+1 where num=:num');

			$query->bindValue(':num',$num,PDO::PARAM_INT);

			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}


	/* 갤러리 테이블 쿼리문*/

		public function galleryCount(){ // 갤러리에 있는 전체 사진 수를 반환하는 함수 입니다. * 미구현
			try{
				$query = $this->db->prepare("select count(*) from gallery");

				$query->execute();

				$result = $query->fetchColumn();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		} // End of galleryCount Function

		public function getFileList($sort, $dir) { // gallery 테이블의 모든 파일 정보를 반환하는 메소드 입니다. $sort : 필드 기준으로 정렬, $dir : 정렬 방향(asc/desc)
			try {
				$query = $this->db->prepare("select * from gallery order by $sort $dir");
				$query->execute();
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		} // End of getFileList Function

		public function addFileInfo($id, $fname, $ftime, $fsize) { // gallery 테이블에 새로운 파일 정보를 입력하는 메소드 입니다.
			try{
				$query = $this->db->prepare("insert into gallery values(:id, :fname, :ftime, :fsize)");

				$query->bindValue(":id",$id,PDO::PARAM_STR);
				$query->bindValue(":fname",$fname,PDO::PARAM_STR);
				$query->bindValue(":ftime",$ftime,PDO::PARAM_STR);
				$query->bindValue(":fsize",$fsize,PDO::PARAM_INT);

				$query->execute();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		} // End of addFileInfo Function

		public function delefeFileInfo($id, $fname){ // 사용자의 ID와 삭제하려는 파일명을 매개변수로 받아 테이블에서 삭제하는 메소드 입니다.
			try{
				$result = $fname;
				$query = $this->db->prepare("delete from gallery where id=:id and fname=:fname");

				$query->bindValue(":id",$id,PDO::PARAM_STR);
				$query->bindValue(":fname",$fname,PDO::PARAM_STR);

				$query->execute();
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		} // End of deleteFilrInfo Function

}