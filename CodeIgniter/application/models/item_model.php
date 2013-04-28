<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Item_Model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }


	public function getItem ($itemId) {


		$sql = "SELECT sg_games.game_id, sg_gamename.game_name, sg_games.game_description, 
				sg_games.game_thumbnail, sg_games.game_yearpub, sg_games.game_totalRating, 
				sg_games.game_totalVotes, sg_games.game_minplayers, sg_games.game_maxplayers,
				sg_games.game_age, sg_games.game_duration
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

	public function getItemRating ($itemId) {
	
		try {
		
			$sql = "SELECT game_totalRating, game_totalVotes
				FROM sg_games
				WHERE game_id = ".$this->db->escape($itemId).";";
		
		
			if ($query = $this->db->query($sql)) {
				$row = $query->row_array();
				return $row;
			}
		}
		catch (Exception $e) {
			
			log_message('error', 'model.Item_Model.getItemRating: Error la puntuacion del item '.$itemId);
			log_message('error', $e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage());
			trigger_error($e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage(), E_USER_ERROR);
		}
		
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
	
	/*
	 * Devuelve las mecanicas de un item
	 */
	public function getItemMechanical ($itemId) {
	
		$sql = "SELECT mechanic_name
			FROM sg_gamemechanic a, sg_games_gamemechanic b
			WHERE a.gamemechanic_id=b.gamemechanic_id AND b.game_id='".$itemId."'";
		$resultado = array();
		if ($query = $this->db->query($sql)) {
			
			foreach ($query->result_array() as $item) {
	
				$resultado [] = $item["mechanic_name"];
			}
		}
	
		return $resultado;
	}
	
	/*
	 * Devuelve las categorias de un item
	*/
	public function getItemCategory ($itemId) {
	
		$sql = "SELECT category_name
			FROM sg_gamecategory a, sg_games_gamecategory b
			WHERE a.gamecategory_id=b.gamecategory_id AND b.game_id='".$itemId."'";
		$resultado = array();
		if ($query = $this->db->query($sql)) {
				
			foreach ($query->result_array() as $item) {
	
				$resultado [] = $item["category_name"];
			}
		}
	
		return $resultado;
	}
	
	
	/*
	 * Devuelve la dependencia del idioma de un item
	*/
	public function getItemLanguageDep ($itemId) {
	
		$sql = "SELECT language_name
			FROM sg_gamelanguagedep a, sg_games_gamelanguagedep b
			WHERE a.gamelanguagedep_id=b.gamelanguagedep_id AND b.game_id='".$itemId."'";
		$resultado = array();
		if ($query = $this->db->query($sql)) {
			
			$row = $query->row_array();
			return $row;
		}
	
		return $resultado;
	}
	
	/*
	 * Devuelve las descriptiones
	 */
	public function getItemDescriptions ($itemId, $code) {
		
		$sql = "SELECT idl.idl_description 
				FROM idl_item_description_lan idl 
				INNER JOIN lan_languages lan ON lan.lan_id=idl.lan_id AND lan.lan_code=".$this->db->escape($code). 
				" WHERE idl.game_id=".$this->db->escape($itemId);
		
		if ($query = $this->db->query($sql)) {
				
			$row = $query->row_array();
			return $row;
		}
		
		return false;
		
	}
	
	/*
	 * Devuelve los titulos
	*/
	public function getItemTitles ($itemId, $code) {
	
		$sql = "SELECT itl.itl_title
				FROM itl_item_title_lan itl
				INNER JOIN lan_languages lan ON lan.lan_id=itl.lan_id AND lan.lan_code=".$this->db->escape($code).
				" WHERE itl.game_id=".$this->db->escape($itemId);
	
		if ($query = $this->db->query($sql)) {
	
			$row = $query->row_array();
			return $row;
		}
	
		return false;
	
	}
	
	/*
	 * Devuelve los ilustradores de un juego
	 */
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

	/*
	 * Buscador de predictivo de items
	 */
	public function predictiveSearchResult ($search) {
		
		$this->load->helper('language');

		$this->load->helper('url');
		$sql = "SELECT sg_games_gamename.game_id, sg_gamename.game_name 
			FROM sg_gamename
			INNER JOIN sg_games_gamename ON sg_games_gamename.gamename_id = sg_gamename.gamename_id and gamename_priority='1'
			WHERE UPPER(sg_gamename.game_name) LIKE '%".strtoupper($search)."%'";


		$resultado = array();
		if ($query = $this->db->query($sql)) {	

			foreach ($query->result_array() as $item) {

				$resultado [] = base_url().$this->lang->lang().'/juego/'.url_title(strtolower($item['game_name'])).'/'.$item["game_id"].'|'.$item['game_name'];
			}

		}

		return $resultado;
	}
	
	/*
	 * Buscador de predictivo de autors
	*/
	public function predictiveSearchAutorResult ($search) {
	
		$this->load->helper('language');
		
		$this->load->helper('url');
		$sql = "SELECT gamedesigner_id, designer_name
			FROM sg_gamedesigner
			WHERE UPPER(designer_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			foreach ($query->result_array() as $item) {
	
				$resultado [] = base_url().$this->lang->lang().'/autor/'.url_title(strtolower($item['designer_name'])).'/'.$item["gamedesigner_id"].'|'.$item['designer_name'];
			}
	
		}
	
		return $resultado;
	}
	

}
/* End of file item_model.php */
/* Location: ./application/model/item_model.php */
