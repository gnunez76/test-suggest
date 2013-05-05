<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BGG_User_Interface extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bgg_user_model');
	}

	public function index($userName = null, $type = null)
	{

		$this->output->enable_profiler(PROFILER_ENABLE);
		$data = $this->bgg_user_model->getUserList ($userName, $type);
		
		var_dump ($data);
		//$this->output->set_output ($data);
	}

/*	
	public function view($slug)
	{
		$data['news'] = $this->news_model->get_news($slug);
	}	
*/
	
}

/* End of file bgg_user_interface.php */
/* Location: ./application/controllers/bgg_user_interface.php */
