<?php

	class Dao {
		private $db;
		public function __construct(){
			try{
				$this->db = new PDO('pgsql:dbname=termproject;host=localhost', 'postgres','password');
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
		}

		public function insertMember($id, $pass, $name, $nick, $phone, $email, $regist_day){ // 회원가입 메소드입니다.
			try{
				$query = $this->db->prepare("insert into member(id, pass, name, nick, phone, email, regist_day)
					values (:id, :pass, :name, :nick, :phone, :email, :regist_day);");

				$query->bindValue(":id",$id,PDO::PARAM_STR);
				$query->bindValue(":pass",$pass,PDO::PARAM_STR);
				$query->bindValue(":name",$name,PDO::PARAM_STR);
				$query->bindValue(":nick",$nick,PDO::PARAM_STR);
				$query->bindValue(":phone",$phone,PDO::PARAM_STR);
				$query->bindValue(":email",$email,PDO::PARAM_STR);
				$query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);

				$query->execute();
			}catch(PDOException $e){
				exit($e->getMessage);
			}
		} //End of insertMember()

		public function getMember($id){ // 사용자의 모든 정보를 가져오는 메소드입니다.
			try{

				$query=$this->db->prepare('select * from member where id = :id;');
				$query->bindValue(":id",$id,PDO::PARAM_INT);
				$query->execute();

				$result = $query->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		} // End of getMember Method

		public function nickCheck($nick){ // 중복되는 닉네임이 있는지 확인하는 메소드입니다.
			try{
				$query = $this->db->prepare("select nick from member where nick = :nick");

				$query->bindValue(":nick",$nick,PDO::PARAM_STR);

				$query->execute();

				$result = $query->fetch(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				exit($e->getMessage());
			}
			return $result;
		}

		public function updateMember($id ,$password, $nick, $phone, $email){
			try{
				$query = $this->db->prepare("update member set pass = :pw , nick = :nick, phone = :phone, email = :email
					where id = :id;");

				$query->bindValue(":pw",$password,PDO::PARAM_STR);
				$query->bindValue(":nick",$nick,PDO::PARAM_STR);
				$query->bindValue(":phone",$phone,PDO::PARAM_STR);
				$query->bindValue(":email",$email,PDO::PARAM_STR);
				$query->bindValue(":id",$id,PDO::PARAM_STR);

				$query->execute();
			}catch(PDOException $e){
				exit($e->getMesage());
			}
		}
	}

?>