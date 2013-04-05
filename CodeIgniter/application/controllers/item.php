<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('item_model');
	}

	public function index ($itemId, $titleItem = null)
	{

		log_message ('debug', 'Mostrando ItemID: '. $itemId);

		$this->output->enable_profiler(TRUE);
		$this->benchmark->mark('Get_Item_start');

		$data = $this->item_model->getItem ($itemId);

		if ($data) {
			log_message ('debug', 'Hay datos');
var_dump ($data);
			$this->load->view('items/item', $data);
		}
		else {
			log_message ('debug', 'No hay datos');
		}

		$this->benchmark->mark('Get_Item_end');
	}
}
/* End of file item.php */
/* Location: ./application/controller/item.php */

