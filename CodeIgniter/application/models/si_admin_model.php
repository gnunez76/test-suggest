<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class SI_Admin_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	/*
	 * Funcion de login
	*/
	public function login($username, $password)
	{
		$this->db->select('au_id, au_username, au_password, au_realname');
		$this->db->from('au_admin_users');
		$this->db->where('au_username', $username);
		$this->db->where('au_password', MD5($password));
		$this->db->where('au_active', 1);
		$this->db->limit(1);
	
		$query = $this->db->get();
	
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	

	
}