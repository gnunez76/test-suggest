<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BGG_Connect_Model extends CI_Model {

	public function __construct()
	{
		
		$this->load->spark('curl/1.2.1');
		$this->load->database();
		$this->load->helper('file');
	}
	
	
	public function proccessData ()
	{
		
		//Busqueda de elementos
		$idInicioBusqueda = 1;
		$idFinBusqueda = 20;
		#$idFinBusqueda = 140719; // Limite a 13:17 - 30/03/2013
		
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
			trigger_error ("No soportado cURL");
			die;
			$res = file_get_contents($url);
		}
	
		return $res;
	}
	
	
	public function getDataGames ($xmlContent) {
	
		$games = simplexml_load_string($xmlContent);
		$data = "";
		$query = "";
		
		foreach ($games as $game) {
	
			// Atributos (string)$game["objectid"] . "\n";
			$name = "";
			$category = "";
			$family = "";
			$designer = "";
			$gameartist = "";
			$artist = "";
			$expansion = "";

			foreach ($game->name as $namepart) {
				if ($namepart['primary']) {
					$namePrimary = true;
				}
				else  {
					$namePrimary = false;
				}
//					echo "<h3>$namepart PRIMARY</h3>";
//				$name .= $namepart . " ";
				$query .= 'INSERT INTO sg_gamename (game_id, game_name, name_primary)
						VALUES ('.$this->db->escape((int)$game['objectid']).', '.
							$this->db->escape(mysql_real_escape_string($namepart)).', '.	
							$this->db->escape($namePrimary).');';

			}

			foreach ($game->boardgamecategory as $gamecategory) {
				//echo "<h3> $gamecategory - ".$gamecategory ["objectid"]."</h3>";
				//$category .= $gamecategory . ", ";

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamecategory['objectid']), 'gamecategory_id', 'sg_gamecategory')) {
//echo "No está duplicado<br>";
					$query .= 'INSERT INTO sg_gamecategory (gamecategory_id, category_name)
							VALUES ('.$this->db->escape((int)$gamecategory['objectid']).', '.
								$this->db->escape(mysql_real_escape_string($gamecategory)).');';

					$query .= 'INSERT INTO sg_games_gamecategory (game_id, gamecategory_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamecategory['objectid']).');';
				}
			}

			foreach ($game->boardgamefamily as $gamefamily) {
//				echo "<h3> $gamefamily - ".$gamefamily ["objectid"]."</h3>";
//				$family .= $gamefamily . ", ";

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamefamily['objectid']), 'gamefamily_id', 'sg_gamefamily')) {
					$query .= 'INSERT INTO sg_gamefamily (gamefamily_id, family_name)
							VALUES ('.$this->db->escape((int)$gamefamily['objectid']).', '.
								$this->db->escape(mysql_real_escape_string($gamefamily)).');';

					$query .= 'INSERT INTO sg_games_gamefamily (game_id, gamefamily_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamefamily['objectid']).');';
				}
			}

			foreach ($game->boardgamedesigner as $gamedesigner) {

//				echo "<h3> $gamedesigner - ".$gamedesigner ["objectid"]."</h3>";
//				$designer .= $gamedesigner . ", ";

				if (!$this->comprobarDuplicados ($this->db->escape((int)$gamedesigner['objectid']), 'gamedesigner_id', 'sg_gamedesigner')) {
					$query .= 'INSERT INTO sg_gamedesigner (gamedesigner_id, designer_name)
							VALUES ('.$this->db->escape((int)$gamedesigner['objectid']).', '.
								$this->db->escape(mysql_real_escape_string($gamedesigner)).');';

					$query .= 'INSERT INTO sg_games_gamedesigner (game_id, gamedesigner_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gamedesigner['objectid']).');';
				}
			}

			foreach ($game->boardgameartist as $gameartist) {

//				echo "<h3> $gameartist - ".$gameartist ["objectid"]."</h3>";
//				$artist .= $gameartist . ", ";
				if (!$this->comprobarDuplicados ($this->db->escape((int)$gameartist['objectid']), 'gameartist_id', 'sg_gameartist')) {
					$query .= 'INSERT INTO sg_gameartist (gameartist_id, artist_name)
							VALUES ('.$this->db->escape((int)$gameartist['objectid']).', '.
								$this->db->escape(mysql_real_escape_string($gameartist)).');';

					$query .= 'INSERT INTO sg_games_gameartist (game_id, gameartist_id)
							VALUES ('.$this->db->escape((int)$game['objectid']).', '.
								$this->db->escape((int)$gameartist['objectid']).');';
				}
				
			}

			foreach ($game->boardgameexpansion as $gameexpansion) {

//				echo "<h3> $gameexpansion - ".$gameexpansion ["objectid"]."</h3>";
//				$expansion .= $gameexpansion . ", ";

				$query .= 'INSERT INTO sg_gamesexpansion (game_id, gameexpansion_id)
						VALUES ('.$this->db->escape((int)$game['objectid']).', '.
							$this->db->escape((int)$gameexpansion['objectid']).');';
			}




			$query .= 'INSERT INTO sg_games (game_id, 
							game_minplayers, 
							game_maxplayers, 
							game_duration, 
							game_age, 
							game_gamename_id, 
							game_description, 
							game_thumbnail, 
							game_image, 
							game_gameexpansion_id, 
							game_gamedesigner_id, 
							game_gameartist_id) 
						VALUES ('.$this->db->escape((int)$game['objectid']).', '.
							$this->db->escape($game->minplayers).', '.	
							$this->db->escape($game->maxplayers).', '.	
							$this->db->escape($game->playingtime).', '.	
							$this->db->escape($game->age).', '.	
							$this->db->escape(1).', '.	
							$this->db->escape(mysql_real_escape_string($game->description)).', "'.	
							$this->db->escape(basename($game->thumbnail)).'", "'.	
							$this->db->escape(basename($game->image)).'", '.	
							$this->db->escape(1).', '.	
							$this->db->escape(1).', '.	
							$this->db->escape(1).');';

			$this->saveImageFileFromURL ($game->thumbnail);
			$this->saveImageFileFromURL ($game->image);

		}
		
//echo $query;die;
		$this->insertToDB ($query);	
		return "Proces terminado";
	}


	/**
	 * TODO Pasar a un helper la obtencion del path de las imagenes
	 */
	public function saveImageFileFromURL ($filePath) {

		$imageData = $this->file_get_contents_curl($filePath); // Leer el contenido del archivo
		$imageName = basename ($filePath);

		$path = CIPATH . 'assets/images/games/' . md5 (substr ($imageName, 0, 4));
		if (!is_dir ($path)) {
//			echo $path . "<br/>";
			mkdir ($path, 0777, true);
		}

		write_file ($path . '/' . $imageName, $imageData);
	}

	public function comprobarDuplicados ($id, $campo, $tabla) {

		$query = "SELECT * FROM ".$tabla." WHERE ".$campo."='".$id."'";
//echo $query . "<br/>";
//		$query = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";

		$result = $this->db->query($query); 
//		echo $result->num_rows() . " - $tabla - ";

//$row = $result->row ();
//echo $row->$campo. "<br>";die;
		if ($result->num_rows() > 0) {
//			echo "$id - Duplicado <br>";
			return true;
		}
		else {
//			echo "$id - No duplicado <br>";
			return false;
		}
		
	}

	public function insertToDB ($query) {


		$this->db->query($query);

//		echo $this->db->affected_rows();

	}
	
}
