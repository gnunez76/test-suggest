<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BGG_Connect_Model extends CI_Model {

	public function __construct()
	{
		
		$this->load->spark('curl/1.2.1');
		$this->load->database();
		$this->load->helper('file');
	}
	
	
	public function proccessData ($idIni = null, $idFin = null)
	{
		
		//Busqueda de elementos
		$idInicioBusqueda = $idIni;
		$idFinBusqueda = $idFin;

		if (is_null ($idIni) && is_null ($idFin)) {
			$idInicioBusqueda = 1;
			$idFinBusqueda = 20;
			//$idFinBusqueda = 140719; // Limite a 13:17 - 30/03/2013
		}

		
		$elementosProcesados = 0;
		$elementosXConsulta = 20;
		
		$parametrosConsulta = '';
		
		$flagProcesadoBucle = false;

		$contadorPeticiones = 0;
		
		$urlAPI = 'http://www.boardgamegeek.com/xmlapi/boardgame/';
		$data = "";
		for ($i = $idInicioBusqueda; $i <= $idFinBusqueda; $i++) {
		
		
			if ($elementosProcesados < $elementosXConsulta) {
		
				$parametrosConsulta .= $i . ",";
				$elementosProcesados++;
				$procesadoBucle = false;
			}
			else {
				$urlConsulta = $urlAPI . $parametrosConsulta;
				//		echo strlen ($urlConsulta) . " - " . $urlConsulta . "\n";
			
				$contadorPeticiones++;
				$this->benchmark->mark('peticion_BGG_'.$contadorPeticiones.'_start');	
				$xmlContent = $this->file_get_contents_curl ($urlConsulta);				
				$this->benchmark->mark('peticion_BGG_'.$contadorPeticiones.'_end');	

				$this->benchmark->mark('procesado_XML_'.$contadorPeticiones.'_start');	
				$data .= $this->getDataGames ($xmlContent);
				$this->benchmark->mark('procesado_XML_'.$contadorPeticiones.'_end');	
		
				$parametrosConsulta = "";
				$elementosProcesados = 0;
				$procesadoBucle = true;
				sleep (2);
			}
		}
		
		if (!$procesadoBucle) {
		
			$urlConsulta = $urlAPI . $parametrosConsulta;

			$contadorPeticiones++;
			$this->benchmark->mark('peticion_BGG_'.$contadorPeticiones.'_start');	
			$xmlContent = $this->file_get_contents_curl ($urlConsulta);				
			$this->benchmark->mark('peticion_BGG_'.$contadorPeticiones.'_end');	

			$this->benchmark->mark('procesado_XML_'.$contadorPeticiones.'_start');	
			$data .= $this->getDataGames ($xmlContent);
			$this->benchmark->mark('procesado_XML_'.$contadorPeticiones.'_end');	
		}
				
		return $data;
	}
	
	/**
	 * Obtencion de contenido de una url con cURL
	 *
	 * @param string $url URL de la página HTML a obtener
	 * @return string Contenido de la página HTML
	 */
	public function file_get_contents_curl($url) 
	{
	
		if (strpos($url,'http://') !== FALSE) {
			
			$curlOptions = array (CURLOPT_RETURNTRANSFER =>1, 
				CURLOPT_HEADER => 0,
				CURLOPT_VERBOSE => 0,
				CURLOPT_SSL_VERIFYPEER => FALSE,
				CURLOPT_TIMEOUT => 30,
//				CURLOPT_HTTPHEADER => Array('Content-type: text/xml; charset=utf-8'),
				CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
			
			$this->curl->create($url);
			
			$this->curl->options($curlOptions);
				
			$res = $this->curl->execute();
		}
		else {
//			trigger_error ("No soportado cURL");
//			die;
			$res = file_get_contents($url);
		}
	
		return $res;
	}
	
	
	public function getDataGames ($xmlContent) {
	
		$games = simplexml_load_string($xmlContent);
		$data = "";
		$query = "";
		$queryName = "";
		$queryCategory = "";
		$queryFamily = "";
		$queryDesigner = "";
		$queryArtist = "";
		$queryExpansion = "";
			
		foreach ($games as $game) {
	
			// Atributos (string)$game["objectid"] . "\n";
			$name = "";
			$category = "";
			$family = "";
			$designer = "";
			$gameartist = "";
			$artist = "";
			$expansion = "";


			$query = 'INSERT INTO sg_games (game_id,
							game_minplayers,
							game_maxplayers,
							game_duration,
							game_age,
							game_description,
							game_yearpub,
							game_thumbnail,
							game_image)
						VALUES ('.$this->db->escape((int)$game['objectid']).', '.
									$this->db->escape((string)$game->minplayers).', '.
									$this->db->escape((string)$game->maxplayers).', '.
									$this->db->escape((string)$game->playingtime).', '.
									$this->db->escape((string)$game->age).', '.
									$this->db->escape(mysql_real_escape_string((string)$game->description)).', '.
									$this->db->escape((string)$game->yearpublished).', '.
									$this->db->escape((string)$game->thumbnail).', '.
									$this->db->escape((string)$game->image).');';
				



			if (!$this->comprobarDuplicados ($this->db->escape((int)$game['objectid']), 'game_id', 'sg_games')) {
				$this->insertToDB ($query);
			
				foreach ($game->name as $namepart) {
					if ($namepart['primary']) {
						$namePrimary = 1;
					}
					else  {
						$namePrimary = 0;
					}


					$queryName = 'INSERT INTO sg_gamename (game_name)
							VALUES ('.$this->db->escape(mysql_real_escape_string((string)$namepart)).'); ';
					$this->insertToDB ($queryName);
					$idGameName  = $this->db->insert_id();
				
					$queryName = 'INSERT INTO sg_games_gamename (game_id, gamename_id, gamename_priority)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape($idGameName).', '.
								$this->db->escape($namePrimary).');';
					$this->insertToDB ($queryName);

				}
			}			

			foreach ($game->poll as $poll) {

				if ($poll['name'] == 'language_dependence') {
					
					$maxVotes = 0;
					$gameLanguageDepId = 0;
					if (isset ($poll->results->result)) {

						foreach ($poll->results->result as $result) {


							if (!$this->comprobarDuplicados ($this->db->escape((int)$result['level']), 'gamelanguagedep_id', 'sg_gamelanguagedep')) {
								$queryCategory = 'INSERT INTO sg_gamelanguagedep (gamelanguagedep_id, language_name)
										VALUES ('.$this->db->escape((int)$result['level']).', '.
											$this->db->escape(mysql_real_escape_string((string)$result['value'])).');';
								$this->insertToDB ($queryCategory);
							}

							if ($result['numvotes'] > $maxVotes) {

								$maxVotes = (int)$result['numvotes'];
								$gameLanguageDepId =  (int)$result['level'];
							}

						}

						if (!$this->comprobarDuplicados ($this->db->escape($gameLanguageDepId), 'gamelanguagedep_id', 'sg_games_gamelanguagedep', 
							'game_id', (int)$game['objectid'])) {

							$queryCategory = 'INSERT INTO sg_games_gamelanguagedep (game_id, gamelanguagedep_id)
									VALUES ('.$this->db->escape((int)$game['objectid']).', '.
											$this->db->escape($gameLanguageDepId).');';
							if ($gameLanguageDepId) {
								$this->insertToDB ($queryCategory);
							}
						}
					}
						
				}
			}

			foreach ($game->boardgamepublisher as $gamepublisher) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamepublisher['objectid']), 'gameeditorial_id', 'sg_gameeditorial')) {
					$queryCategory = 'INSERT INTO sg_gameeditorial (gameeditorial_id, editorial_name)
							VALUES ('.$this->db->escape((int)$gamepublisher['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gamepublisher)).');';
					$this->insertToDB ($queryCategory);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamepublisher['objectid']), 'gameeditorial_id', 'sg_games_gameeditorial', 
					'game_id', (int)$game['objectid'])) {
					$queryCategory = 'INSERT INTO sg_games_gameeditorial (game_id, gameeditorial_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamepublisher['objectid']).');';
					$this->insertToDB ($queryCategory);
				}
			}
			

			foreach ($game->boardgamecategory as $gamecategory) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamecategory['objectid']), 'gamecategory_id', 'sg_gamecategory')) {
					$queryCategory = 'INSERT INTO sg_gamecategory (gamecategory_id, category_name)
							VALUES ('.$this->db->escape((int)$gamecategory['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gamecategory)).');';
					$this->insertToDB ($queryCategory);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamecategory['objectid']), 'gamecategory_id', 'sg_games_gamecategory', 
					'game_id', (int)$game['objectid'])) {
					
					$queryCategory = 'INSERT INTO sg_games_gamecategory (game_id, gamecategory_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamecategory['objectid']).');';
					$this->insertToDB ($queryCategory);
				}
			}

			foreach ($game->boardgamefamily as $gamefamily) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamefamily['objectid']), 'gamefamily_id', 'sg_gamefamily')) {
					$queryFamily = 'INSERT INTO sg_gamefamily (gamefamily_id, family_name)
							VALUES ('.$this->db->escape((int)$gamefamily['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gamefamily)).');';
					$this->insertToDB ($queryFamily);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamefamily['objectid']), 'gamefamily_id', 'sg_games_gamefamily', 
					'game_id', (int)$game['objectid'])) {

					$queryFamily = 'INSERT INTO sg_games_gamefamily (game_id, gamefamily_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamefamily['objectid']).');';
					$this->insertToDB ($queryFamily);
				}
			}

			foreach ($game->boardgamedesigner as $gamedesigner) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamedesigner['objectid']), 'gamedesigner_id', 'sg_gamedesigner')) {
					$queryDesigner = 'INSERT INTO sg_gamedesigner (gamedesigner_id, designer_name)
							VALUES ('.$this->db->escape((int)$gamedesigner['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gamedesigner)).');';
					$this->insertToDB ($queryDesigner);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamedesigner['objectid']), 'gamedesigner_id', 'sg_games_gamedesigner', 
					'game_id', (int)$game['objectid'])) {

					$queryDesigner = 'INSERT INTO sg_games_gamedesigner (game_id, gamedesigner_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamedesigner['objectid']).');';
					$this->insertToDB ($queryDesigner);
				}
			}

			foreach ($game->boardgameartist as $gameartist) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gameartist['objectid']), 'gameartist_id', 'sg_gameartist')) {
					$queryArtist = 'INSERT INTO sg_gameartist (gameartist_id, artist_name)
							VALUES ('.$this->db->escape((int)$gameartist['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gameartist)).');';
					$this->insertToDB ($queryArtist);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gameartist['objectid']), 'gameartist_id', 'sg_games_gameartist', 
					'game_id', (int)$game['objectid'])) {
					
					$queryArtist = 'INSERT INTO sg_games_gameartist (game_id, gameartist_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gameartist['objectid']).');';
					$this->insertToDB ($queryArtist);
				}
				
			}

			foreach ($game->boardgameexpansion as $gameexpansion) {


				if (!$this->comprobarDuplicados ($this->db->escape((int)$game['objectid']), 
						'game_id', 'sg_games_gameexpansion', 'gameexpansion_id', 
						$this->db->escape((int)$gameexpansion['objectid']))) {
				
					$queryExpansion = 'INSERT INTO sg_games_gameexpansion (game_id, gameexpansion_id)
						VALUES ('.$this->db->escape((int)$game['objectid']).', '.
							$this->db->escape((int)$gameexpansion['objectid']).');';
					$this->insertToDB ($queryExpansion);
				}
			}




			foreach ($game->boardgamemechanic as $gamemechanic) {

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamemechanic['objectid']), 'gamemechanic_id', 'sg_gamemechanic')) {
					$queryArtist = 'INSERT INTO sg_gamemechanic (gamemechanic_id, mechanic_name)
							VALUES ('.$this->db->escape((int)$gamemechanic['objectid']).', '.
								$this->db->escape(mysql_real_escape_string((string)$gamemechanic)).');';
					$this->insertToDB ($queryArtist);
				}
					
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamemechanic['objectid']), 'gamemechanic_id', 'sg_games_gamemechanic', 
					'game_id', (int)$game['objectid'])) {
					
					$queryArtist = 'INSERT INTO sg_games_gamemechanic (game_id, gamemechanic_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamemechanic['objectid']).');';
					$this->insertToDB ($queryArtist);
				}
				
			}


		}
		
		return "Proceso terminado";
	}


	/**
	 * TODO Pasar a un helper la obtencion del path de las imagenes
	 */
	public function saveImageFileFromURL ($filePath) {

		$imageData = $this->file_get_contents_curl($filePath); // Leer el contenido del archivo
		$imageName = basename ($filePath);

		$path = CIPATH . 'assets/images/games/' . md5 (substr ($imageName, 0, 5));
		if (!is_dir ($path)) {
//			echo $path . "<br/>";
			mkdir ($path, 0777, true);
		}

		write_file ($path . '/' . $imageName, $imageData);
	}

	public function comprobarDuplicados ($id, $campo, $tabla, $campo2=null, $id2=null) {

		$query = "SELECT * FROM ".$tabla." WHERE ".$campo."='".$id."'";
		if (!is_null($campo2) && !is_null($id2)) {
			$query .= " AND ".$campo2."='".$id2."'";
		}
		$result = $this->db->query($query); 

		if ($result->num_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
		
	}

	public function insertToDB ($query) {


		$this->db->query($query);

//		echo $this->db->affected_rows();

	}
	
	public function cleanTable  ($texto, $idBase) {
		
		$sql = "SELECT gamelanguagedep_id 
				FROM sg_gamelanguagedep 
				WHERE language_name=".$this->db->escape($texto);
		
		
		$query = $this->db->query($sql);
		
		if ($rows = $query->result_array()) {
			
			foreach ($rows as $row) {
							
				echo $row ['gamelanguagedep_id'] . " - ";
				$sql = "UPDATE sg_games_gamelanguagedep SET gamelanguagedep_id=".$this->db->escape($idBase).
				" WHERE gamelanguagedep_id=".$this->db->escape($row['gamelanguagedep_id']);

				echo $sql . "<br>";
				$this->db->query($sql);
			}
				
		}		
	}
	
	
}
