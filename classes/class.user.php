<?php

class User{

	private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	// Ham bam mat khau, crypt(mot cach de bam chuoi), substr(quay lai 1 phan cua chuoi), str_replace(thay the chuoi tim kiem voi chuoi thay the)
	public function creat_hash($value){
		return $hash = crypt($value, '$ash#%&@'.substr(str_replace('+', '.', base64_encode(sha1(microtime(true),true))),0,22));
	}

	// Xac minh viec bam
	private function verify_hash($password, $hash){
		return $hash == crypt($password, $hash);
	}

	// Xac minh mat khau phu hop voi mat khau duoc cung cap tren form dang nhap
	private function get_user_hash($username){

		try{
			$data = $this->db->prepare('SELECT password FROM blog_members WHERE username = :username');
			$data->execute(array('username' => $username));
			$row = $data->fetch();
			return $row['password'];
		}catch(PDOExeption $e){
			echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}

	public function login($username, $password){
		$hashed = $this->get_user_hash($username);

		if ($this->verify_hash($password,$hashed) == 1) {
			$_SESSION['loggedin'] = true;
			return true;
		}
	}

	public function logout(){
		session_destroy();
	}
}

?>