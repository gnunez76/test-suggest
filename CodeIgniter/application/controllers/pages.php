<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{

$this->output->enable_profiler(TRUE);
$this->benchmark->mark('view_controller_start');

			if ( ! file_exists('application/views/pages/'.$page.'.php'))
			{
				// Whoops, we don't have a page for that!
				show_404();
			}
			
			$data['title'] = ucfirst($page); // Capitalize the first letter
			
			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer', $data);

$this->benchmark->mark('view_controller_end');

//echo $this->benchmark->elapsed_time('codigo_inicio', 'codigo_fin');

	}
}

