<?php

class Registrar extends CI_Model {
	function get_all_emails()
	{
	return $this->db->query("SELECT email FROM users")->result_array();
	}

	function get_user_by_email($email)
	{
		return $this->db->query('SELECT * FROM users WHERE email = ?', array($email))->row_array();
	}

	function add_user($user)
	{
		$query = 'INSERT INTO users (first_name, last_name, email, password, created_at) VALUES (?,?,?,?,?)';
		$values = array($user['first_name'], $user['last_name'],$user['email'],$user['password'], date("Y-m-d, H:i:s"));
		return $this->db->query($query, $values);
	}

}
