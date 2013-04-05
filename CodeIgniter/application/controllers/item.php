<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->model('item_model');
		$this->load->helper('url');
	}

	public function index ($itemId, $titleItem = null)
	{

		$this->output->enable_profiler(TRUE);
		log_message ('debug', 'Mostrando ItemID: '. $itemId);

		$this->benchmark->mark('Get_Item_start');

		$data = $this->item_model->getItem ($itemId);

		$designer = $this->item_model->getItemCreator ($itemId);
		$editorial = $this->item_model->getItemEditorial ($itemId);
		$artist = $this->item_model->getItemArtist ($itemId);

		$data ["autor"] = $designer; 
		$data ["editorial"] = $editorial; 
		$data ["artist"] = $artist; 

		if (isset($data['game_name'])) {
			log_message ('debug', 'Hay datos');
			$currentUrl = current_url();
			$realUrl = base_url().'juego/'.url_title(strtolower($data['game_name'])).'/'.$itemId;

			if ($currentUrl != $realUrl) {
				header ('HTTP/1.1 301 Moved Permanently');
  				header ('Location: '.$realUrl);
			}

			$this->load->view('items/item', $data);
		}
		else {
			log_message ('debug', 'No hay datos');
			show_404();
		}

		$this->benchmark->mark('Get_Item_end');
	}

	public function buscador () {
	
		$data = $this->item_model->predictiveSearchResult($_GET['term']);	
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		
	}
}
/* End of file item.php */
/* Location: ./application/controller/item.php */

