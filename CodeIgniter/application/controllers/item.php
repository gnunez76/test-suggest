<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		
		$this->load->helper('url');
	}

	public function index ($itemId, $titleItem = null)
	{

		$this->output->enable_profiler(FALSE);
		log_message ('debug', 'Mostrando ItemID: '. $itemId);

		$this->benchmark->mark('Get_Item_start');
		$this->load->model('item_model');
		$data = $this->item_model->getItem ($itemId);
		
		$data ["autor"] = $this->item_model->getItemCreator ($itemId); 
		$data ["editorial"] = $this->item_model->getItemEditorial ($itemId); 
		$data ["artist"] = $this->item_model->getItemArtist ($itemId);
		
		$this->load->model ('user_suggest_model');
		$data ["reviews"] = $this->user_suggest_model->getAllReviewsItem ($itemId);

//		var_dump ($data);die;

		if (isset($data['game_name'])) {
			log_message ('debug', 'Hay datos');
			$currentUrl = current_url();
			$realUrl = base_url().'juego/'.url_title(strtolower($data['game_name'])).'/'.$itemId;

			if ($currentUrl != $realUrl) {
				header ('HTTP/1.1 301 Moved Permanently');
  				header ('Location: '.$realUrl);
			}

			$this->load->view('templates/header', $data);
			$this->load->view('items/item', $data);
			$this->load->view('templates/footer');
		}
		else {
			log_message ('debug', 'No hay datos');
			show_404();
		}

		$this->benchmark->mark('Get_Item_end');
	}

	/*
	 * Para el buscador predictivo, busca items
	 */
	public function buscador () {
	
		$this->load->model('item_model');
		$data = $this->item_model->predictiveSearchResult($_GET['term']);	
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		
	}
	
	/*
	 * Para el buscador predictivo, busca autores
	 */
	public function autor () {
	
		$this->load->model('item_model');
		$data = $this->item_model->predictiveSearchAutorResult($_GET['term']);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	
	}
	
	
	public function rateItem ($game_id, $ratingValue) {

		$this->load->helper('cookie');
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			$user_profile = $this->hybridauthlib->authenticate($provider)->getUserProfile();
				
			$this->load->model ('user_suggest_model');
			$rateGame = $this->user_suggest_model->getRateUserItem ($game_id, $user_profile->identifier);
			
			if ($rateGame) {

				log_message('debug', 'controllers.Item.rateItem: El juego esta puntuado '.$rateGame.' puntos por el usuario '.$user_profile->identifier);
				
				$modTotalRating = $ratingValue - $rateGame;
				
				$this->user_suggest_model->updateRateUserItem ($game_id, $user_profile->identifier, $ratingValue);
				$this->user_suggest_model->modifyItemTotalRating ($game_id, $modTotalRating);
				
				
				echo "el juego est� puntuado ";
			}
			else {
				
				log_message('debug', 'controllers.Item.rateItem: El juego no ha sido puntuado por el usuario '.$user_profile->identifier);
				log_message('debug', 'controllers.Item.rateItem: El usuario '.$user_profile->identifier.' puntua el juego '. $game_id. ' con '.$ratingValue.'puntos');
				
				$this->user_suggest_model->setRateUserItem ($game_id, $user_profile->identifier, $ratingValue);
				$this->user_suggest_model->updateItemTotalRating ($game_id, $ratingValue);
				
				
				echo 'el juego NO ha sido puntuado aun';
			}
			
			echo $user_profile->identifier . ' - ' . $provider . ' - ' . $game_id . " - " . $ratingValue;
				
		}
		else {
			
			echo "Es necesario estar logado para poder votar";
		}
		
			
	}
	
	public function getUserRating ($itemId) {

		$this->output->enable_profiler(false);
		
		$this->load->helper('cookie');
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		$data ['itemId'] = $itemId;

		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');
			
			$data ['user_profile'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
		
			$this->load->model ('user_suggest_model');
			$data ['rateGame'] = $this->user_suggest_model->getRateUserItem ($itemId, $data['user_profile']->identifier);
			$data ['userReview'] = $this->user_suggest_model->getReviewUserItem ($itemId, $data['user_profile']->identifier);
				
			if ($data ['rateGame']) {
										
				log_message('debug', 'controllers.Item.getUserRating: Item con '.$data['rateGame'].
				' puntos del usuario '.$data['user_profile']->identifier);
				
				echo "<!-- el juego esta puntuado -->";
			}
			else {
				
				$data ['rateGame'] = 0;
		
				echo '<!-- el juego NO ha sido puntuado aun -->';
			}
			
		}
		else {
				
			echo "<!-- Es necesario estar logado para poder votar -->";
		}
		
		$this->load->view('items/user_data_item', $data);
	}
}
/* End of file item.php */
/* Location: ./application/controller/item.php */

