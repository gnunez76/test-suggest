<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Administracion
class SI_Admin extends CI_Controller {

	
	public function __construct() 
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->model('si_admin_model');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->view('admin/admin_login');		
	}

	function verifylogin()
	{
		$this->load->model('si_admin_model','',TRUE);
			
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		
		
		
		if($this->form_validation->run() == FALSE)
		{
			
			//Field validation failed.&nbsp; User redirected to login page
			$this->load->view('admin/admin_login');
		}
		else
		{
			
			//Go to private area
			redirect('/si_admin/home', 'refresh');
		}

	}

	function check_database($password)
	{
		//Field validation succeeded.&nbsp; Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->si_admin_model->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
						'id' => $row->au_id,
						'username' => $row->au_username,
						'name' => $row->au_realname
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
		
	function home()
	{
		
		
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			

			
			$this->load->view('admin/header_admin', $data);
			$this->load->view('admin/footer_admin', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('/si_admin/', 'refresh');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('si_admin/home', 'refresh');
	}

	
		
	

}

/* End of file si_admin.php */
/* Location: ./application/controllers/si_admin.php */
