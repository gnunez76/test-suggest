<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BGG_Connect extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bgg_connect_model');
	}

	public function index()
	{
		$this->output->enable_profiler(TRUE);
		$data = $this->bgg_connect_model->proccessData ();
		
		
		$this->output->set_output ($data);
	}

/*	
	public function view($slug)
	{
		$data['news'] = $this->news_model->get_news($slug);
	}	
*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/bggconnect.php */
