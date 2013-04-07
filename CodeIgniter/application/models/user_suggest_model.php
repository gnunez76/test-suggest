<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_Suggest_Model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


	public function setUser ($dataUser, $provider) {

		try {

			if (isset ($dataUser->email)) {
				$sql = "INSERT INTO usr_users (usr_identifier, usr_profileURL, usr_photoURL, usr_name, usr_email, usr_provider)
						VALUES (".$this->db->escape($dataUser->identifier)."," 
							.$this->db->escape($dataUser->profileURL)."," 
							.$this->db->escape($dataUser->photoURL)."," 
							.$this->db->escape($dataUser->displayName).","
							.$this->db->escape($dataUser->email).","
							.$this->db->escape($provider).");";
			}
			else {	
				$sql = "INSERT INTO usr_users (usr_identifier, usr_profileURL, usr_photoURL, usr_name, usr_provider)
						VALUES (".$this->db->escape($dataUser->identifier)."," 
							.$this->db->escape($dataUser->profileURL)."," 
							.$this->db->escape($dataUser->photoURL)."," 
							.$this->db->escape('@'.$dataUser->displayName).","
							.$this->db->escape($provider).");";
			}
			
			$this->benchmark->mark('insert_user_profile_start');
			$query = $this->db->query($sql);
			$this->benchmark->mark('insert_user_profile_end');
		}
		catch (Exception $e) {
			log_message('error', 'model.User_Suggest_Model.setUser: Error al insertar usuario en la BD');
			log_message('error', $e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage());
			trigger_error($e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage(), E_USER_ERROR);
		}
		
		
	}

	public function userExists ($userId) {

		try {
			$sql = "SELECT usr_id FROM usr_users
					WHERE usr_identifier='".$userId."'";

			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {

				//El usuario existe
				return true;
			}
			else {

				//El usuario no existe
				return false;
			}
		}
		catch (Exception $e) {
			var_dump ($e);

		}
	}

	public function getItem ($itemId) {


		$sql = "SELECT sg_games.game_id, sg_gamename.game_name, sg_games.game_description, sg_games.game_thumbnail, sg_games.game_yearpub
			FROM sg_games
			INNER JOIN sg_games_gamename ON sg_games_gamename.game_id = sg_games.game_id and gamename_priority='1'
			INNER JOIN sg_gamename ON sg_gamename.gamename_id = sg_games_gamename.gamename_id
			WHERE sg_games.game_id = '".$itemId."'";


		if ($query = $this->db->query($sql)) {	
			$row = $query->row_array();
			return $row;
		}

		return false;

	}

	public function getItemCreator ($itemId) {

		$sql = "SELECT designer_name 
			FROM sg_gamedesigner a, sg_games_gamedesigner b
			WHERE a.gamedesigner_id=b.gamedesigner_id AND b.game_id='".$itemId."'";
		$resultado = array();
		if ($query = $this->db->query($sql)) {	

			foreach ($query->result_array() as $item) {

				$resultado [] = $item["designer_name"];
			}
		}

		return $resultado;
	}

	public function getItemEditorial ($itemId) {

		$sql = "SELECT editorial_name 
			FROM sg_gameeditorial a, sg_games_gameeditorial b
			WHERE a.gameeditorial_id=b.gameeditorial_id AND b.game_id='".$itemId."'";

		$resultado = array();
		if ($query = $this->db->query($sql)) {	

			foreach ($query->result_array() as $item) {

				$resultado [] = $item["editorial_name"];
			}

		}

		return $resultado;
	}

	public function getItemArtist ($itemId) {

		$sql = "SELECT artist_name 
			FROM sg_gameartist a, sg_games_gameartist b
			WHERE a.gameartist_id=b.gameartist_id AND b.game_id='".$itemId."'";

		$resultado = array();
		if ($query = $this->db->query($sql)) {	

			foreach ($query->result_array() as $item) {

				$resultado [] = $item["artist_name"];
			}

		}

		return $resultado;
	}

	public function predictiveSearchResult ($search) {

		$this->load->helper('url');
		$sql = "SELECT sg_games_gamename.game_id, sg_gamename.game_name 
			FROM sg_gamename
			INNER JOIN sg_games_gamename ON sg_games_gamename.gamename_id = sg_gamename.gamename_id and gamename_priority='1'
			WHERE UPPER(sg_gamename.game_name) LIKE '%".strtoupper($search)."%'";


		$resultado = array();
		if ($query = $this->db->query($sql)) {	

			foreach ($query->result_array() as $item) {

				$resultado [] = base_url().'juego/'.url_title(strtolower($item['game_name'])).'/'.$item["game_id"].'|'.$item['game_name'];
			}

		}

		return $resultado;
	}

}
/* End of file item_model.php */
/* Location: ./application/model/item_model.php */
