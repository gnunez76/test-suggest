<?php

class Comments extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
//		$this->load->model('item_model');
//		$this->load->helper('url');
	}

	public function getItemComments ($itemId = null) {

//		$this->load->view('comments/comment');
//		echo "Obtener Comentarios";
	}


	public function loadComments ($itemId = null) {

	//	$this->load->view('comments/comment');
	}

	public function insertItemComment ($itemId = null) {
	
		$titulo = $_POST['titulo'];
		$texto = $_POST['texto'];
		
		$this->load->helper('cookie');
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			$user_profile = $this->hybridauthlib->authenticate($provider)->getUserProfile();
		
			$this->load->model ('user_suggest_model');
			$commentItem = $this->user_suggest_model->getReviewUserItem ($itemId, $user_profile->identifier);
				
			if ($commentItem) {
		
				log_message('debug', 'controllers.Item.rateItem: El juego esta comentado por el usuario '.$user_profile->identifier);
				
				$this->user_suggest_model->updateReviewUserItem ($itemId, $user_profile->identifier, $titulo, $texto);
				
				echo "el juego est‡ puntuado ";
			}
			else {
		
				log_message('debug', 'controllers.Item.ReviewItem: El usuario '.$user_profile->identifier.' crea una review sobre el juego');
		
				$this->user_suggest_model->setReviewUserItem ($itemId, $user_profile->identifier, $titulo, $texto);
		
		
				echo 'el juego NO ha sido puntuado aun';
			}
				
			echo $user_profile->identifier . ' - ' . $provider . ' - ' . $itemId . " - ";
		
		}
		else {
				
			echo "Es necesario estar logado para poder votar";
		}
		

		echo "-- Insertar comentario";
	}


}
