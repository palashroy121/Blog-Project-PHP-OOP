<?php

include_once "Session.php";
include "Database.php";

class Blog {

	private $db;
	public function __construct(){
		$this -> db = new Database();
	}

	public function selectCat() {
		$sql = "SELECT * FROM blog_category WHERE status = 1";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//User Registration Save Function
	public function user_register_save($data) {
		$name		= $data['name'];
		$user_name	= $data['user_name'];
		$address	= $data['address'];
		$email		= $data['email'];
		$password	= $data['password'];

		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];
		$folder = "image/";
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$file_f_name = rtrim($file_name, '.'.$file_ext);
		$unique_name =$file_f_name.time().'.'.$file_ext;
		move_uploaded_file($file_temp, $folder.$unique_name);

		$chk_email = $this -> emailCheck($email);
		$msg[]="";
		if($name == ""){
			$msg['name'] = '<p class="text-danger"><strong>Error ! </strong>Name must not be empty!</p>';
		}
		if($user_name == ""){
			$msg['user_name'] = '<p class="text-danger"><strong>Error ! </strong>User Name must not be empty!</p>';
		}
		else if(strlen($user_name) < 6) {
			$msg['user_name'] = '<p class="text-danger"><strong>Error ! </strong>User name is too short. Maximum 6 character!</p>';
		}
		else if(preg_match('/[^a-z1-9_-]+/i', $user_name)) {
			$msg['user_name'] = '<p class="text-danger"><strong>Error ! </strong>User name must only contain alphanumerical, dashes and underscore!</p>';
		}
		if($file_name == ""){
			$msg['image'] = '<p class="text-danger"><strong>Error ! </strong>Select any Image!</p>';
		}
		else if($file_size > 10000000){
			$msg['image'] = '<p class="text-danger"><strong>Error ! </strong>Image size too large!</p>';
		}
		else if(in_array($file_ext, $permited) === false){
			$msg['image'] = '<p class="text-danger"><strong>Error ! </strong>You can uploded only: '.implode(', ', $permited).'.</p>';
		}
		if($address == ""){
			$msg['address'] = '<p class="text-danger"><strong>Error ! </strong>Address must not be empty!</p>';
		}
		if($email == ""){
			$msg['email'] = '<p class="text-danger"><strong>Error ! </strong>Email must not be empty!</p>';
		}
		else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg['email'] = '<p class="text-danger"><strong>Error ! </strong>The email address is not valid!</p>';
		}
		else if($chk_email == true) {
			$msg['email'] = '<p class="text-danger"><strong>Error ! </strong>The email address already Exist!</p>';
		}
		if($password == ""){
			$msg['password'] = '<p class="text-danger"><strong>Error ! </strong>Password must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO blog_user (name, user_name, address, image, email, password) VALUES (:name, :user_name, :address, :image, :email, :password)";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":name", $name);
		$query -> bindValue(":user_name", $user_name);
		$query -> bindValue(":address", $address);
		$query -> bindValue(":image", $unique_name);
		$query -> bindValue(":email", $email);
		$query -> bindValue(":password", $password);
		$result = $query -> execute();

		$newId = $this->db -> conn -> lastInsertId();
		//$result = $this -> get_login_check($email, $password);
		if($result){
			Session::init();
			Session::set("login", true);
			Session::set("id", $newId);
			Session::set("name", $name);
			Session::set("user_name", $user_name);
			Session::set("loginmsg", '<p class="text-success"><strong>Success ! </strong>You are Registered.</p');
			header ("Location: index.php");
		}
		else{
			$msg = '<p class="text-danger"><strong>Error ! </strong>Data Not Found!</p>';
			return $msg;
		}

	}
	//End Registration Function
	public function emailCheck($email) {
		$sql = "SELECT email FROM blog_user WHERE email = :email";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":email", $email);
		$query -> execute();
		if($query -> rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	//End Email Check Function

	public function check_login($data) {
		$email = $data['email'];
		$password = $data['password'];

		$chk_email = $this -> emailCheck($email);
		//$msg[]="";
		if($email == ""){
			$msg['email'] = '<p class="text-danger"><strong>Error ! </strong>Field must not be empty!</p>';
		}
		else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg['email'] = '<p class="text-danger"><strong>Error ! </strong>The email address is not valid!</p>';
		}
		if($password == ""){
			$msg['password'] = '<p class="text-danger"><strong>Error ! </strong>Field must not be empty!</p>';
		}

		if(!empty($msg)){
			return $msg;
		}

		$result = $this -> get_login_check($email, $password);
		if($result){
			Session::init();
			Session::set("login", true);
			Session::set("id", $result -> user_id);
			Session::set("name", $result -> name);
			Session::set("user_name", $result -> user_name);
			Session::set("loginmsg", '<p class="text-success"><strong>Success ! </strong>You are Login.</p>');
			header ("Location: index.php");
		}
		else{
			$msg = '<p class="text-danger"><strong>Error ! </strong>Data Not Found!</p>';
			return $msg;
		}
	}

	//
	public function get_login_check($email, $password) {
		$sql = "SELECT * FROM blog_user WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":email", $email);
		$query -> bindValue(":password", $password);
		$query -> execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}

	//Save Post
	public function save_post($data, $id) {
		//print_r($id);
		//exit();
		$cat_id			= $data['cat_id'];
		$post_title		= $data['post_title'];
		$post			= $data['post'];
		$status			= $data['status'];

		$user_id = $id;

		$created_at = date('Y-m-d H:i:s');

		$sql = "INSERT INTO blog_post (cat_id, user_id, post_title, post, created_at, status) VALUES (:cat_id, :user_id, :post_title, :post, :created_at, :status)";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":cat_id", $cat_id);
		$query -> bindValue(":user_id", $user_id);
		$query -> bindValue(":post_title", $post_title);
		$query -> bindValue(":post", $post);
		$query -> bindValue(":created_at", $created_at);
		$query -> bindValue(":status", $status);
		$result = $query -> execute();
	}

	// Select All Blog Post
	public function selectBlogPost($page) {

		if($page == "" || $page == "1") {
			$page_num = 0;
		}
		else {
			$page_num = (($page*4)-4);
		}

		$sql = "SELECT blog_user.*, blog_post.* FROM blog_user INNER JOIN blog_post ON blog_user.user_id=blog_post.user_id WHERE blog_user.status = 1 ORDER BY post_id DESC LIMIT $page_num, 4";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//Pagination 
	public function pagination() {
		$sql = "SELECT * FROM blog_post WHERE status = 1";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$count = $query -> rowCount();
		$pagi_page = ceil($count/4);
		return $pagi_page;
	}

	//Hit Count
	public function update_hit($Sid) {
		//$hit = 0;
		$sql = "UPDATE blog_post SET hit = hit+1 WHERE post_id = :id";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":id", $Sid);
		$result = $query->execute();
	}

	//View Blog Details
	public function selectBlogById($Sid) {
		$sql = "SELECT blog_user.*, blog_post.* FROM blog_user INNER JOIN blog_post ON blog_user.user_id=blog_post.user_id WHERE post_id = $Sid";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		$HitCount = $this -> update_hit($Sid);
		return $result;
	}

	//Recent Post
	public function selectRecentPost() {
		$sql = "SELECT * FROM blog_post WHERE status = 1 ORDER BY post_id DESC LIMIT 5";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}
	
	//Top Hit Post
	public function topHitPost() {
		$sql = "SELECT * FROM blog_post WHERE status = 1 ORDER BY hit DESC LIMIT 5";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//Select Cat Page Post
	public function selectCatPost($catName, $page) {
		if($page == "" || $page == "1") {
			$page_num = 0;
		}
		else {
			$page_num = (($page*4)-4);
		}

		$sql = "SELECT blog_category.*, blog_post.*, blog_user.*  FROM (blog_category INNER JOIN blog_post ON blog_category.cat_id=blog_post.cat_id) INNER JOIN blog_user ON blog_post.user_id=blog_user.user_id WHERE blog_post.status = 1 AND blog_category.cat_name = '$catName' ORDER BY post_id DESC LIMIT $page_num, 4";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//Cat Pagination
	public function cat_pagination($catName) {
		$sql = "SELECT blog_category.*, blog_post.* FROM blog_category INNER JOIN blog_post ON blog_category.cat_id=blog_post.cat_id WHERE blog_post.status = 1 AND blog_category.cat_name = '$catName'";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$count = $query -> rowCount();
		$pagi_page = ceil($count/4);
		return $pagi_page;
	}

	//Save Comment
	public function save_comment($data, $id) {
		$post_id = $data['post_id'];
		$comment = $data['comment'];
		$created_at = date('Y-m-d H:i:s');

		$sql = "INSERT INTO blog_comment (post_id, user_id, comment, created_at) VALUES (:post_id, :user_id, :comment, :created_at)";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":post_id", $post_id);
		$query -> bindValue(":user_id", $id);
		$query -> bindValue(":comment", $comment);
		$query -> bindValue(":created_at", $created_at);
		$result = $query -> execute();
	}

	//View Comment
	public function view_comment($Sid) {
		$sql = "SELECT * FROM blog_comment WHERE post_id=$Sid";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//View User Profile
	public function view_user($id) {
		$sql = "SELECT * FROM blog_user WHERE user_id = $id";
		$query = $this->db -> conn -> prepare($sql);
		$query -> execute();
		$result = $query -> fetchAll();
		return $result;
	}

	//Change Password
	public function updatePassword($id, $data) {
		$old_password = $_POST['old_password'];
		$new_password = $_POST['password'];

		$checkPass = $this->checkPassword($id, $old_password);
		//$msg[] = "";
		if($old_password == ""){
			$msg['old_password'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if($checkPass == false){
			$msg['old_password'] = '<p class="text-danger"><strong>Error! </strong>Old Password not Exist!</p>';
		}
		if($new_password == ""){
			$msg['new_password'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if(strlen($new_password) < 6){
			$msg['new_password'] = '<p class="text-danger"><strong>Error! </strong>Password is too Short!</p>';
		}

		if(!empty($msg)){
			return $msg;
		}

		$sql = "UPDATE blog_user SET password = :password WHERE user_id = :id";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":password", $new_password);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		//var_dump($result);
		if($result){
			$msg = '<p class="text-success"><strong>Success! </strong>Password Update Successfully.</p>';
			return $msg;
		}
		else {
			$msg = '<p class="text-danger"><strong>Error ! </strong>Password Does not Updated!</p>';
			return $msg;
		}

	}

	public function checkPassword($id, $old_password) {
		$sql = "SELECT user_id, password FROM blog_user WHERE user_id = :id AND password = :password";
		$query = $this->db -> conn -> prepare($sql);
		$query -> bindValue(":id", $id);
		$query -> bindValue(":password", $old_password);
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