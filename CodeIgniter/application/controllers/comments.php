<?php

class Comments extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
//		$this->load->model('item_model');
//		$this->load->helper('url');
	}

	public function getItemComments ($itemId = null) {

		$this->load->view('comments/comment');
//		echo "Obtener Comentarios";
	}


	public function loadComments ($itemId = null) {

		$this->load->view('comments/comment');
	}

	public function insertItemComment ($itemId = null) {
	
		var_dump ($_POST);

		echo "-- Insertar comentario";
	}


}
