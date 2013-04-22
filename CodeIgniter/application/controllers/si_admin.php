<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Administración
class SI_Admin extends CI_Controller {

	
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	public function index()
	{
		
		echo "hola";
		
	}
}

/* End of file si_admin.php */
/* Location: ./application/controllers/si_admin.php */
