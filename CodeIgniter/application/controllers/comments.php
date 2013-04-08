<?php

class Comments extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
//		$this->load->model('item_model');
//		$this->load->helper('url');
	}

	public function getItemComments ($itemId) {

		$this->load->view('comments/comment');
//		echo "Obtener Comentarios";
	}



	public function insertItemComment ($itemId) {

		echo "-- Insertar comentario";
	}


}
