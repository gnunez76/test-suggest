<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Interface extends CI_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->load->helper('url');
	}
	
	
	public function setReview ($itemId) {
		
		$this->output->enable_profiler(TRUE);
		
		
		$this->load->helper('cookie');

		$data ['itemId'] = $itemId;
		
		$userName = get_cookie ('SI_UserName');
		$provider = get_cookie ('SI_Provider');
		
		if (!empty($userName) && !empty($provider)) {
			$this->load->library('HybridAuthLib');

			$this->benchmark->mark('user_data_start');
			$data ['isLogin'] = true;
			$data ['user_profile'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
			$this->benchmark->mark('user_data_end');
			
			$this->benchmark->mark('get_rate_start');
			$this->load->model ('user_suggest_model');
			$data ['rateGame'] = $this->user_suggest_model->getRateUserItem ($itemId, $data['user_profile']->identifier);
			$data ['reviewItem'] = $this->user_suggest_model->getReviewUserItem ($itemId, $data['user_profile']->identifier);
			
			if ($data ['reviewItem']) {
				
				$data ['reviewItemAutores'] = $this->user_suggest_model->getReviewDesignerRel($data ['reviewItem']['comment_id']);
				$data ['reviewItemItems'] = $this->user_suggest_model->getReviewItemRel($data ['reviewItem']['comment_id']);
			}
			
			$this->benchmark->mark('get_rate_end');
				
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
			$data ['isLogin'] = false;
			echo "<!-- Es necesario estar logado para poder votar -->";
		}
		
		//Output
		$this->load->view('items/review_form', $data);
				
	}
	
	
}