<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class SI_Admin_Model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	/*
	 * Funcion de login
	*/
	public function login($username, $password)
	{
		$this->db->select('au_id, au_username, au_password, au_realname');
		$this->db->from('au_admin_users');
		$this->db->where('au_username', $username);
		$this->db->where('au_password', MD5($password));
		$this->db->where('au_active', 1);
		$this->db->limit(1);
	
		$query = $this->db->get();
	
		if($query->num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	public function getNumItems () {
		return $this->db->count_all('sg_games');
	}
	
	/*
	 * Devuelve listado de items
	 */
	public function getItems ($iniLimit=0, $limit=25) {
		
		$this->db->select ('sg_games.game_id, sg_gamename.game_name, sg_games.game_yearpub, sg_games.game_thumbnail, sg_games.game_totalRating, sg_games.game_totalVotes');
		$this->db->from ('sg_games');
		$this->db->join ('sg_games_gamename', 'sg_games.game_id=sg_games_gamename.game_id AND sg_games_gamename.gamename_priority=1');
		$this->db->join ('sg_gamename', 'sg_gamename.gamename_id=sg_games_gamename.gamename_id');
		$this->db->limit ($limit, $iniLimit);
		
		$query = $this->db->get();
		
		if ($rows = $query->result_array()) {
			return $rows;
		}
		else {
			return false;
		}
		
		
	}

	public function getItem ($itemId) {
	
		$sql = "SELECT sg_games.game_id, sg_games.game_description,
				sg_games.game_thumbnail, sg_games.game_image, sg_games.game_yearpub, sg_games.game_totalRating,
				sg_games.game_totalVotes, sg_games.game_minplayers, sg_games.game_maxplayers,
				sg_games.game_age, sg_games.game_duration
			FROM sg_games
			WHERE sg_games.game_id = '".$itemId."'";
		
	
		if ($query = $this->db->query($sql)) {
			$row = $query->row_array();
			return $row;
		}
	
		return false;
	
	}
	
	public function getGameNames ($itemId) {
		$sql = "SELECT sg.gamename_id, sg.game_name, sgg.gamename_priority, sgg.active 
				FROM sg_gamename sg
				INNER JOIN sg_games_gamename sgg ON sgg.gamename_id=sg.gamename_id AND sgg.game_id=".$this->db->escape($itemId).
				" ORDER BY sgg.gamename_priority DESC";
		
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
				
		return false;
		
	}
	
	public function getItemCreator ($itemId) {
	
		$sql = "SELECT a.gamedesigner_id, designer_name, b.active
			FROM sg_gamedesigner a, sg_games_gamedesigner b
			WHERE a.gamedesigner_id=b.gamedesigner_id AND b.game_id='".$itemId."'";
		
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	
	public function getItemEditorial ($itemId) {
	
		$sql = "SELECT a.gameeditorial_id, editorial_name, b.active
			FROM sg_gameeditorial a, sg_games_gameeditorial b
			WHERE a.gameeditorial_id=b.gameeditorial_id AND b.game_id='".$itemId."'";
	
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	
	public function getItemArtist ($itemId) {
	
		$sql = "SELECT a.gameartist_id, a.artist_name, b.active
			FROM sg_gameartist a, sg_games_gameartist b
			WHERE a.gameartist_id=b.gameartist_id AND b.game_id='".$itemId."'";
	
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	
	/*
	 * Devuelve las mecanicas de un item
	*/
	public function getItemMechanical ($itemId) {
	
		$sql = "SELECT a.gamemechanic_id,  a.mechanic_name, b.active
			FROM sg_gamemechanic a, sg_games_gamemechanic b
			WHERE a.gamemechanic_id=b.gamemechanic_id AND b.game_id='".$itemId."'";
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}

	/*
	 * Devuelve las categorias de un item
	*/
	public function getItemCategory ($itemId) {
	
		$sql = "SELECT a.gamecategory_id, a.category_name, b.active
			FROM sg_gamecategory a, sg_games_gamecategory b
			WHERE a.gamecategory_id=b.gamecategory_id AND b.game_id='".$itemId."'";
		
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}

	/*
	 * Devuelve la dependencia del idioma de un item
	*/
	public function getItemLanguageDep ($itemId) {
	
		$sql = "SELECT a.gamelanguagedep_id, a.language_name
			FROM sg_gamelanguagedep a, sg_games_gamelanguagedep b
			WHERE a.gamelanguagedep_id=b.gamelanguagedep_id AND b.game_id='".$itemId."'";

		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	
	/*
	 * Devuelve todos las dependencias del lenguaje
	 */
	public function getAllLanDep () {
		
		$sql = "SELECT a.gamelanguagedep_id, a.language_name
			FROM sg_gamelanguagedep a";	

		if ($query = $this->db->query($sql)) {
		
			return $query->result_array();
		}
		
		return false;
		
	}
	
	/*
	 * Activa o desactiva el autor
	 */
	public function changeActiveAutor ($autorId, $itemId, $active) {
		
		$sql = "UPDATE sg_games_gamedesigner 
				SET active=".$this->db->escape($active).
				" WHERE gamedesigner_id=".$this->db->escape($autorId).
				" AND  game_id=".$this->db->escape($itemId);
		
		$this->db->query($sql);	
	}

	
	/*
	 * Activa o desactiva el nombre del item
	 */
	public function changeActiveItemName ($nameId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gamename
				SET active=".$this->db->escape($active).
				" WHERE gamename_id=".$this->db->escape($nameId).
				" AND  game_id=".$this->db->escape($itemId);
	
		$this->db->query($sql);
	}

	/*
	 * Activa o desactiva el nombre del ilustrador
	*/
	public function changeActiveArtist ($artistId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gameartist
				SET active=".$this->db->escape($active).
				" WHERE gameartist_id=".$this->db->escape($artistId).
				" AND  game_id=".$this->db->escape($itemId);
	
		$this->db->query($sql);
	}

	/*
	 * Activa o desactiva la editorial
	*/
	public function changeActiveEditorial ($editorialId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gameeditorial
				SET active=".$this->db->escape($active).
					" WHERE gameeditorial_id=".$this->db->escape($editorialId).
					" AND  game_id=".$this->db->escape($itemId);
	
		$this->db->query($sql);
	}

	/*
	 * Activa o desactiva las mecanicas
	*/
	public function changeActiveMechanic ($mechanicId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gamemechanic
				SET active=".$this->db->escape($active).
					" WHERE gamemechanic_id=".$this->db->escape($mechanicId).
					" AND  game_id=".$this->db->escape($itemId);
	
		$this->db->query($sql);
	}
	
	/*
	 * Activa o desactiva las categorias
	*/
	public function changeActiveCategory ($categoryId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gamecategory
				SET active=".$this->db->escape($active).
					" WHERE gamecategory_id=".$this->db->escape($categoryId).
					" AND  game_id=".$this->db->escape($itemId);
	
		$this->db->query($sql);
	}
	
}