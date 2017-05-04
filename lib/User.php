<?php

include_once "Session.php";
include "Database.php";

class User {
	private $db;
	public function __construct(){
		$this -> db = new Database();
	}

	//Check User Login Funtion
	public function get_login_check($email, $password) {
		$sql = "SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":email", $email);
		$query -> bindValue(":password", $password);
		$query -> execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function check_user_login($data) {
		$email = $data['email'];
		$password = $data['password'];

		if($email == "" OR $password == ""){
			$msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty!</div>';
			return $msg;
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg = '<div class="alert alert-danger"><strong>Error ! </strong>The email address is not valid!</div>';
			return $msg;
		}

		$result = $this -> get_login_check($email, $password);
		if($result){
			Session::init();
			Session::set("login", true);
			Session::set("id", $result -> id);
			Session::set("name", $result -> name);
			Session::set("email", $result -> email);
			Session::set("loginmsg", '<div class="alert alert-success"><strong>Success ! </strong>You are Login.</div>');
			header ("Location: dashboard.php");
		}
		else{
			$msg = '<div class="alert alert-danger"><strong>Error ! </strong>Data Not Found!</div>';
			return $msg;
		}
	}
	//User Login Function End
	
	public function getUserData() {
		$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}
	//View User Data Fanction End

	public function getUserById($userid) {
		$sql = "SELECT * FROM tbl_user WHERE id = $userid LIMIT 1";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":id", $userid);
		$query -> execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//End

	public function updateUserData($userid, $data) {
		$name = $data['name'];
		$username = $data['username'];
		$email = $data['email'];

		if($name == "" OR $username == "" OR $email == ""){
			$msg = '<div class="alert alert-danger"><strong>Error! </strong>Field must not be empty!</div>';
			return $msg;
		}
		
		$sql = "UPDATE tbl_user SET name = :name, username = :username, email = :email WHERE id = :userid";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":name", $name);
		$query -> bindValue(":username", $username);
		$query -> bindValue(":email", $email);
		$query -> bindValue(":id", $userid);
		$result = $query->execute();
		var_dump($result);
		if($result){
			$msg = '<div class="alert alert-success"><strong>Success! </strong>User Data Update Successfully.</div>';
			return $msg;
		}
		else {
			$msg = '<div class="alert alert-danger"><strong>Error ! </strong>User Data Does not Updated!</div>';
			return $msg;
		}
	}
	//End

	public function updatePassword($id, $data) {
		$old_password = $_POST['old_password'];
		$new_password = $_POST['password'];

		if($old_password == "" OR $new_password == ""){
			$msg = '<div class="alert alert-danger"><strong>Error! </strong>Field must not be empty!</div>';
			return $msg;
		}

		$checkPass = $this->checkPassword($id, $old_password);

		if($checkPass == false){
			$msg = '<div class="alert alert-danger"><strong>Error! </strong>Old Password not Exist!</div>';
			return $msg;
		}

		if(strlen($new_password) < 6){
			$msg = '<div class="alert alert-danger"><strong>Error! </strong>Password is too Short!</div>';
			return $msg;
		}

		$password = md5($new_password);

		$sql = "UPDATE tbl_user SET password = :password WHERE id = :id";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":password", $password);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		var_dump($result);
		if($result){
			$msg = '<div class="alert alert-success"><strong>Success! </strong>Password Update Successfully.</div>';
			return $msg;
		}
		else {
			$msg = '<div class="alert alert-danger"><strong>Error ! </strong>Password Does not Updated!</div>';
			return $msg;
		}

	}

	private function checkPassword($id, $old_password) {
		$password = md5($old_password);
		$sql = "SELECT id, password FROM tbl_user WHERE id = :id AND password = :password";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":id", $id);
		$query -> bindValue(":password", $password);
		$query -> execute();
		if($query -> rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	} 

}

?>