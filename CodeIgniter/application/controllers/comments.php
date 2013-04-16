<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		$notas_privadas = $_POST['notas_privadas'];
		$juegos = $_POST['juegos'];		
		$autores = $_POST['autores'];	
		
		if (isset ($_POST['sharetwitter'])) {	
			$sharetwitter = $_POST['sharetwitter'];
		}
		
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
				
				$this->user_suggest_model->updateReviewUserItem ($itemId, $user_profile->identifier, $titulo, $texto, $notas_privadas);
				$this->user_suggest_model->deleteReviewDesignerRel($itemId, $user_profile->identifier);
				$this->user_suggest_model->setReviewDesignerRel ($itemId, $user_profile->identifier, $autores);
				$this->user_suggest_model->deleteReviewItemRel($itemId, $user_profile->identifier);
				$this->user_suggest_model->setReviewItemRel ($itemId, $user_profile->identifier, $juegos);
				
			}
			else {
		
				log_message('debug', 'controllers.Item.ReviewItem: El usuario '.$user_profile->identifier.' crea una review sobre el juego');
		
				$this->user_suggest_model->setReviewUserItem ($itemId, $user_profile->identifier, $titulo, $texto, $notas_privadas);
				$this->user_suggest_model->setReviewDesignerRel ($itemId, $user_profile->identifier, $autores);
				$this->user_suggest_model->setReviewItemRel ($itemId, $user_profile->identifier, $juegos);
		
			}
				
			echo 'OK';
		
		}
		else {
				
			echo 'KO';
		}
		
	}

	
	public function insertReviewComment ($itemId = null) {
	
		$parentid = $_POST['parentid'];
		$texto = $_POST['texto'];
	
		$this->load->helper('cookie');
	
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
	
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			$user_profile = $this->hybridauthlib->authenticate($provider)->getUserProfile();
	
			$this->load->model ('user_suggest_model');	
			log_message('debug', 'controllers.Item.ReviewItem: El usuario '.$user_profile->identifier.' crea una review sobre el juego');
			$this->user_suggest_model->setCommentUserReview ($itemId, $user_profile->identifier, $texto, $parentid);
	
			echo $user_profile->identifier . ' - ' . $provider . ' - ' . $itemId . " - ";
	
		}
		else {
	
			echo "Es necesario estar logado para poder votar";
		}
	
	}
	
	
	public function getLikeButton ($commentId) {
		$this->output->enable_profiler(false);
		
		$data ['commentId'] = $commentId;
		$this->load->helper('cookie');
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			$user_profile = $this->hybridauthlib->authenticate($provider)->getUserProfile();
		
			$this->load->model ('user_suggest_model');
			log_message('debug', 'controllers.Item.ReviewItem: El usuario '.$user_profile->identifier.' crea una review sobre el juego');
			$this->user_suggest_model->getLikeUserReview ($user_profile->identifier, $commentId);
			
			$data["literal"] = 'ME GUSTA';
		
		}
		else {
		
			$data["literal"] = 'TE GUSTA';
		}		
		
		
		
		$this->load->view('comments/likebutton', $data);
	}
	
	public function likeThisReview ($commentId) {
		
		
		$this->load->helper('cookie');
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			$user_profile = $this->hybridauthlib->authenticate($provider)->getUserProfile();
		
			$this->load->model ('user_suggest_model');
			log_message('debug', 'controllers.Item.ReviewItem: El usuario '.$user_profile->identifier.' crea una review sobre el juego');
			$this->user_suggest_model->setControlLikeReview ($user_profile->identifier, $commentId);
			$this->user_suggest_model->setLikeReview ($user_profile->identifier, $commentId);
			
				
		}
		else {
		
			echo "Es necesario estar logado para poder votar";
		}
		
	}
	

	/*
	 * Devuelve todas las rese–as de un item
	 */
	public function getAllReviews ($itemId) {
		
		$this->output->enable_profiler(false);
		
		$data ['itemId'] = $itemId;
		
		$this->load->model ('user_suggest_model');
		$data ["reviews"] = $this->user_suggest_model->getAllReviewsItem ($itemId);
		
		$this->load->view('comments/reviews', $data);
	}
	
	public function getReviewsComments ($itemId, $commentId) {
		
		$this->output->enable_profiler(FALSE);
		$data ['itemId'] = $itemId;
		$data ['commentId'] = $commentId;
		
		$this->load->model ('user_suggest_model');
		$data ['hijos'] = $this->user_suggest_model->getAllCommentsReviews ($itemId, "comment_date ASC", $commentId);
		
		//echo "<pre>"; var_dump ($data); echo "</pre>";die;
		
		$this->load->view('comments/reviewcomments', $data);
		
		
	}
	
	
}
