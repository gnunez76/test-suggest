<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BGG_Connect extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bgg_connect_model');
	}

	public function index($idIni = null, $idFin = null)
	{

		$this->output->enable_profiler(TRUE);
		$data = $this->bgg_connect_model->proccessData ($idIni, $idFin);
		
		
		$this->output->set_output ($data);
	}
	
	public function clean () {
		
		$this->output->enable_profiler(TRUE);
		$this->bgg_connect_model->cleanTable ('No necessary in-game text', 1);
		$this->bgg_connect_model->cleanTable ('Some necessary text - easily memorized or small crib sheet', 2);
		$this->bgg_connect_model->cleanTable ('Moderate in-game text - needs crib sheet or paste ups', 3);
		$this->bgg_connect_model->cleanTable ('Extensive use of text - massive conversion needed to be playable', 4);
		$this->bgg_connect_model->cleanTable ('Unplayable in another language', 5);
		
		
		
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
