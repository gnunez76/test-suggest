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
	
	public function getExpansions ($itemId) {
		
		$sql = "SELECT sg.game_name, sgg.game_id, sge.active
				FROM sg_gamename sg
				INNER JOIN sg_games_gamename sgg ON sgg.gamename_id=sg.gamename_id	AND sgg.gamename_priority=1		
				INNER JOIN sg_games_gameexpansion sge ON sge.gameexpansion_id=sgg.game_id AND sge.game_id=".$this->db->escape($itemId);
		
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
	 * Devuelve todos las dependencias del lenguaje de un determinado idioma
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
	 * Devuelve los idiomas disponibles 
	 */
	public function getAllLanguages () {
		
		$sql = "SELECT lan_id, lan_description
				FROM lan_languages";
		
		if ($query = $this->db->query($sql)) {
		
			return $query->result_array();
		}
		
		return false;
	}
	
	/*
	 * Devuelve el numero de comentarios de una review 
	 * 
	 */
	public function getReviewComments ($reviewId) {
		
		$sql = "SELECT count(comment_id) as total
				FROM si_comments
				WHERE comment_parent_id=".$this->db->escape ($reviewId);

		if ($query = $this->db->query($sql)) {
		
			return $query->result_array();
		}
		
		return false;
		
	}
	
	/*
	 * Devuelve el numero de comentarios de una review
	*
	*/
	public function getReviewTitle ($reviewId) {
	
		$sql = "SELECT comment_title as titulo
				FROM si_comments
				WHERE comment_id=".$this->db->escape ($reviewId);
	
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
	 * Activa o desactiva la expansion
	*/
	public function changeActiveExpansion ($expansionId, $itemId, $active) {
	
		$sql = "UPDATE sg_games_gameexpansion
				SET active=".$this->db->escape($active).
					" WHERE gameexpansion_id=".$this->db->escape($expansionId).
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
	
	/*
	 * Actualiza informacion de un item
	 */
	public function updateItem ($data) {
		
		$sql = "UPDATE sg_games 
				SET game_yearpub=".$this->db->escape($data["yearpub"]).
				", game_minplayers=".$this->db->escape($data["minplayer"]).
				", game_maxplayers=".$this->db->escape($data["maxplayer"]).
				", game_age=".$this->db->escape($data["age"]).
				", game_duration=".$this->db->escape($data["duration"]).
				", game_description=".$this->db->escape($data["bgg_description"]).
				" WHERE game_id=".$this->db->escape($data["itemId"]);
		
		$this->db->query($sql);
	}
	
	/*
	 * Actualiza la dependencia linguistica del item
	 */
	public function updateItemLanDep ($data) {
		
		$sql = "UPDATE sg_games_gamelanguagedep
				SET gamelanguagedep_id=".$this->db->escape($data["deplenguaje"]).
				" WHERE game_id=".$this->db->escape($data["itemId"]);
		
		$this->db->query ($sql);
	}
	
	/*
	 * Actualiza las descripciones NO-BGG del item
	 */
	public function updateItemDescriptions ($data) {
		
		if (isset ($data ['description']) && is_array($data ['description'])) {
			
			while (list ($lan_id, $description) = each ($data ['description'])) {
				
				$sql = "UPDATE idl_item_description_lan
						SET idl_description=".$this->db->escape($description).
						" WHERE lan_id=".$this->db->escape($lan_id).
						" AND game_id=".$this->db->escape($data ['itemId']);
				
				$this->db->query ($sql);
			}
		}
		
	}
	
	/*
	 * Actualiza los titulos NO-BGG del item
	*/
	public function updateItemTitles ($data) {
	
		if (isset ($data ['newTitleLan']) && is_array($data ['newTitleLan'])) {
				
			while (list ($lan_id, $title) = each ($data ['newTitleLan'])) {
	
				$sql = "UPDATE itl_item_title_lan
						SET itl_title=".$this->db->escape($title).
							" WHERE lan_id=".$this->db->escape($lan_id).
							" AND game_id=".$this->db->escape($data ['itemId']);
	
				$this->db->query ($sql);
			}
		}
	
	}
	
	
	/*
	 * Añade un nuevo nombre al item
	 */
	public function insertNewName ($itemId, $newName) {
		
		$sql = "INSERT INTO sg_gamename (game_name)
				VALUES (".$this->db->escape($newName).")";
		
		
		$this->db->query($sql);
		
		$gamenameId = $this->db->insert_id();

		$sql = "INSERT INTO sg_games_gamename (gamename_id, game_id)
				VALUES (".$this->db->escape($gamenameId).","
				.$this->db->escape($itemId).")";
		
		$this->db->query($sql);
	}
	

	/*
	 * Añade un diseñador al item
	 */
	public function addDesignerToItem ($itemId, $designerId) {
		
		$sql = "INSERT INTO sg_games_gamedesigner (game_id, gamedesigner_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($designerId).")";
		
		$this->db->query($sql);
	}
	
	/*
	 * Añade un artista al item
	*/
	public function addArtistToItem ($itemId, $artistId) {
	
		$sql = "INSERT INTO sg_games_gameartist (game_id, gameartist_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($artistId).")";
	
		$this->db->query($sql);
	}

	/*
	 * Añade un editorial al item
	*/
	public function addEditorialToItem ($itemId, $editorialId) {
	
		$sql = "INSERT INTO sg_games_gameeditorial (game_id, gameeditorial_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($editorialId).")";
	
		$this->db->query($sql);
	}

	/*
	 * Añade una mecanica al item
	*/
	public function addMechanicToItem ($itemId, $mechanicId) {
	
		$sql = "INSERT INTO sg_games_gamemechanic (game_id, gamemechanic_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($mechanicId).")";
	
		$this->db->query($sql);
	}
	
	/*
	 * Añade una categoria al item
	*/
	public function addCategoryToItem ($itemId, $categoryId) {
	
		$sql = "INSERT INTO sg_games_gamecategory (game_id, gamecategory_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($categoryId).")";
	
		$this->db->query($sql);
	}	
	
	/*
	 * Añade una expansion al item
	*/
	public function addExpansionToItem ($itemId, $expansionId) {
	
		$sql = "INSERT INTO sg_games_gameexpansion (game_id, gameexpansion_id)
				VALUES (".$this->db->escape($itemId).",".$this->db->escape($expansionId).")";
	
		$this->db->query($sql);
	}	
	
	
	/*
	 * Buscador de predictivo de autors
	*/
	public function predictiveSearchAutorResult ($search) {
	
		$sql = "SELECT gamedesigner_id, designer_name
			FROM sg_gamedesigner
			WHERE UPPER(designer_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();	
		}
	
		return false;
	}
	
	
	/*
	 * Buscador de predictivo de ilustradores
	*/
	public function predictiveSearchArtistResult ($search) {
	
		$sql = "SELECT gameartist_id, artist_name
			FROM sg_gameartist
			WHERE UPPER(artist_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	

	/*
	 * Buscador de predictivo de editoriales
	*/
	public function predictiveSearchEditorialResult ($search) {
	
		$sql = "SELECT gameeditorial_id, editorial_name
			FROM sg_gameeditorial
			WHERE UPPER(editorial_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}

	/*
	 * Buscador de predictivo de editoriales
	*/
	public function predictiveSearchMechanicResult ($search) {
	
		$sql = "SELECT gamemechanic_id, mechanic_name
			FROM sg_gamemechanic
			WHERE UPPER(mechanic_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}

	
	/*
	 * Buscador de predictivo de categorias
	*/
	public function predictiveSearchCategoryResult ($search) {
	
		$sql = "SELECT gamecategory_id, category_name
			FROM sg_gamecategory
			WHERE UPPER(category_name) LIKE '%".strtoupper($search)."%'";
	
	
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}
	
	/*
	 * Buscador de predictivo de categorias
	*/
	public function predictiveSearchItemResult ($search) {
	
		$sql = "SELECT sg_games_gamename.game_id, sg_gamename.game_name 
			FROM sg_gamename
			INNER JOIN sg_games_gamename ON sg_games_gamename.gamename_id = sg_gamename.gamename_id and gamename_priority='1'
			WHERE UPPER(sg_gamename.game_name) LIKE '%".strtoupper($search)."%'";
		
		$resultado = array();
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}	
	
	/*
	 * A�ade una nueva descripcion y su idioma. Antes comprueba que no exista.
	 */
	public function addDescriptionToItem ($itemId, $description, $lanId){
		
		$sql = "SELECT idl_id
				FROM idl_item_description_lan
				WHERE lan_id=".$this->db->escape($lanId).
				" AND game_id=".$this->db->escape($itemId);
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1) {
			return "KO";
		}
		else {
			
			$sql = "INSERT INTO idl_item_description_lan (idl_description, lan_id, game_id)
					VALUES (".$this->db->escape($description).",".$this->db->escape($lanId).",".$this->db->escape($itemId).")";
			
			$this->db->query($sql);
			
			return "OK";
		}
	}
	

	/*
	 * A�ade un nuevo titulo y su idioma. Antes comprueba que no exista.
	*/
	public function addTitleLanToItem ($itemId, $title, $lanId){
	
		$sql = "SELECT itl_id
				FROM itl_item_title_lan
				WHERE lan_id=".$this->db->escape($lanId).
					" AND game_id=".$this->db->escape($itemId);
	
		$query = $this->db->query($sql);
	
		if($query->num_rows() == 1) {
			return "KO";
		}
		else {
				
			$sql = "INSERT INTO itl_item_title_lan (itl_title, lan_id, game_id)
					VALUES (".$this->db->escape($title).",".$this->db->escape($lanId).",".$this->db->escape($itemId).")";
				
			$this->db->query($sql);
				
			return "OK";
		}
	}
	
	
	
	
	/*
	 * Devuelve otras descripciones de un item
	 */
	public function getOtherItemDescriptions ($itemId) {
		
		$sql = "SELECT idl_description, lan_description, idl.lan_id 
				FROM idl_item_description_lan idl
				INNER JOIN lan_languages lan ON lan.lan_id=idl.lan_id
				WHERE idl.game_id=".$this->db->escape($itemId);
		
		if ($query = $this->db->query($sql)) {
		
			return $query->result_array();
		}
		
		return false;
	}
	

	/*
	 * Devuelve otras titulos de un item en otros idiomas
	*/
	public function getOtherItemTitles ($itemId) {
	
		$sql = "SELECT itl_title, lan_description, itl.lan_id
				FROM itl_item_title_lan itl
				INNER JOIN lan_languages lan ON lan.lan_id=itl.lan_id
				WHERE itl.game_id=".$this->db->escape($itemId);
	
		if ($query = $this->db->query($sql)) {
	
			return $query->result_array();
		}
	
		return false;
	}	
	
}