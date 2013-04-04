<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BGG_user_Model extends CI_Model {

    public function __construct()
    {

        $this->load->spark('curl/1.2.1');
        $this->load->database();
//        $this->load->helper('file');
    }

	public function getUserList ($userName, $type) {

		return $this->processData ($userName, $type);
	}

	public function processData ($userName, $type) {

		$xmlContent = $this->getData ($userName, $type);
		if ($games = simplexml_load_string($xmlContent)) {

			foreach ($games as $item) {

				$gameId = (int)$item ['objectid'];
			
				foreach ($item->stats as $stats) {
	
					$ratingValue = (int)$stats->rating['value'];
				}


				$comment = $item->comment;


				$sql = "INSERT INTO user_game_rates (usr_id, game_id, rating, comment)
						values ('".$this->db->escape(1) ."','". 
							$this->db->escape($gameId) ."','".
							$this->db->escape($ratingValue) ."','".
							$this->db->escape($comment) ."');";


				echo $sql . "<br/>";
			}
		}


	}

	public function getData ($userName, $type, $condition = 1) {

		$url = 'http://www.boardgamegeek.com/xmlapi/collection/'.$userName.'?'.$type.'='.$condition;


		// Start session (also wipes existing/previous sessions)
		$this->curl->create($url);

		$curlOptions = array (CURLOPT_RETURNTRANSFER =>1,
			CURLOPT_HEADER => 0,
			CURLOPT_VERBOSE => 0,
			CURLOPT_SSL_VERIFYPEER => FALSE,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTPHEADER => Array('Content-type: text/xml; charset=utf-8'),
			CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');

		$this->curl->options($curlOptions);
		$data = $this->curl->execute();

		return $data;
		
	}


}
/* End of file bgg_user_model.php */
/* Location: ./application/model/bgg_user_model.php */
