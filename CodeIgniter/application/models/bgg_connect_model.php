<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BGG_Connect_Model extends CI_Model {

	public function __construct()
	{
		
		$this->load->spark('curl/1.2.1');
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
				
				$xmlContent = $this->file_get_contents_curl ($urlConsulta);				
				$data .= $this->getDataGames ($xmlContent);
		
				$parametrosConsulta = "";
				$elementosProcesados = 0;
				$procesadoBucle = true;
			}
		}
		
		if (!$procesadoBucle) {
		
			$urlConsulta = $urlAPI . $parametrosConsulta;
			$xmlContent = $this->file_get_contents_curl ($urlConsulta);						
			$data .= $this->getDataGames ($xmlContent);
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
		foreach ($games as $game) {
	
			// Atributos (string)$game["objectid"] . "\n";
			$name = "";
			foreach ($game->name as $namepart) {
				$name .= $namepart . " ";
			}
	
			$data .= (string)$game["objectid"] . "  -- " . $name . " - " .$game->thumbnail . "<br/>";
		}
	
		return $data;
	}
	
	
}