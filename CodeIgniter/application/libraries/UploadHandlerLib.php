<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/third_party/UploadHandler/UploadHandler.php';

class UploadHandlerLib extends UploadHandler
{
	function __construct()
	{
		$ci =& get_instance();
		$ci->load->helper('url_helper');

//		$config['base_url'] = site_url((config_item('index_page') == '' ? SELF : '').$config['base_url']);

		parent::__construct();

		log_message('debug', 'UploadHandlerLib Class Initalized');
	}
}

/* End of file HybridAuthLib.php */
/* Location: ./application/libraries/HybridAuthLib.php */
