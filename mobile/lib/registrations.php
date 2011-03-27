<?php

class Registrations {

	private $db_link = null;
	private $db_host = "localhost";
	private $db_user = "blipter";
	private $db_password = "blipmySqlftW0";
	private $db_name = "blipter";
	private $db_table = "users";
	private $salt = "imju3stsom1eawe3someran3domsaltfor5thewin";

	public $error_messages = array();

	/**
	 * Creates new user
	 *
	 * @param array $user_data 
	 * @return boolean
	 */
	public function create_account($user_data) {

		if (!$this->validate_user_data($user_data)) {
			return false;
		}

		if ($this->db_link == null) {
			$this->mysql_create();
		}

		$email = mysql_real_escape_string($user_data['email']);
		$email = strtolower($email);
		$password = hash_hmac('sha1', $user_data['password'], $this->salt.$email);
		$newsletter = empty($user_data['newsletter']) ? 0 : 1;
				
		$query  = "INSERT INTO `{$this->db_table}` VALUES (NULL, '{$email}', {$newsletter}, '{$password}', NOW())";

		$success = @mysql_query($query);
		@mysql_close($this->db_link);
		$this->db_link = null;
		
		if (!$success) {
			$this->error_messages[] = "Wait, you're already registered aren't you?";
			return false;
		}
		
		return true;
	}

	/**
	 * Returns a registered user by his credentials
	 *
	 * @param string $email 
	 * @param string $password 
	 * @return mixed Array on success, null on failure.
	 */
	public function get_user($email, $password) {
		if ($this->db_link == null) {
			$this->mysql_create();
		}

		$email = mysql_real_escape_string($email);
		$email = strtolower($email);
		$password = hash_hmac('sha1', $password, $this->salt.$email);
						
		$query  = "SELECT * FROM `{$this->db_table}` WHERE email = '{$email}' AND  password = '{$password}'";
		$result = @mysql_query($query);
		
		// ToDo: close mysql link.
		
		if (!$result || (mysql_num_rows($result) == 0)) {
			$this->error_messages[] = "Sorry, that email or password aren't registered.";
			return null;
		}
		
		return mysql_fetch_assoc($result);
	}

	private function validate_user_data($user_data) {

		if (!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error_messages[] = "The email is invalid.";
		}
		
		if (empty($user_data['password'])) {
			$this->error_messages[] = "The password can't be empty.";
		}
		else if ($user_data['password'] == "somepass") {
			$this->error_messages[] = "You must enter a password.";
		}
		
		if (!empty($this->error_messages)) {
			return false;
		}
		
		return true;
	}
	
	private function mysql_create() {
		$this->db_link = @mysql_connect($this->db_host, $this->db_user, $this->db_password);
		
		if (!$this->db_link)
			die("Can't connect to database");

		if (!@mysql_select_db($this->db_name))
			die("Can't select database");
	}
	
	function __destruct() {
		if ($self->db_link != null) {
			@mysql_close($this->db_link);
			$this->db_link = null;
		}
	}
}

?>