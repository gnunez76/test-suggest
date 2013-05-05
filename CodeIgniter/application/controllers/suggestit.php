<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuggestIt extends CI_Controller {

	public function index()
	{

$this->output->enable_profiler(PROFILER_ENABLE);
$this->benchmark->mark('home_suggest_it_start');

				// Whoops, we don't have a page for that!
		//		show_404();
			

		$this->load->view('templates/header');
		$this->load->view('templates/footer');

$this->benchmark->mark('home_suggest_it_end');

//echo $this->benchmark->elapsed_time('codigo_inicio', 'codigo_fin');

	}
	
}

