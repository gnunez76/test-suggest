<?php

#error_reporting (E_ALL);

//Busqueda de elementos

$idInicioBusqueda = 1;
$idFinBusqueda = 20;
#$idFinBusqueda = 140719; // Limite a 13:17 - 30/03/2013

$elementosProcesados = 0;
$elementosXConsulta = 20;

$parametrosConsulta = '';

$flagProcesadoBucle = false;

$urlAPI = 'http://www.boardgamegeek.com/xmlapi/boardgame/';



/**
 * Obtencion de contenido de una url con cURL
 *
 * @param string $url URL de la página HTML a obtener
 * @return string Contenido de la página HTML
 */
function file_get_contents_curl($url) {

        if (strpos($url,'http://') !== FALSE) {
                $fc = curl_init();
                curl_setopt($fc, CURLOPT_URL,$url);
                curl_setopt($fc, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($fc, CURLOPT_HEADER,0);
                curl_setopt($fc, CURLOPT_VERBOSE,0);
                curl_setopt($fc, CURLOPT_SSL_VERIFYPEER,FALSE);
                curl_setopt($fc, CURLOPT_TIMEOUT,30);
curl_setopt($fc, CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22');
                $res = curl_exec($fc);
                curl_close($fc);
        }
       else {
		trigger_error ("No soportado cURL");
		die;
                $res = file_get_contents($url);
        }

        return $res;
}


function getDataGames ($xmlContent) {

	$games = simplexml_load_string($xmlContent);

	foreach ($games as $game) {

// Atributos (string)$game["objectid"] . "\n";
		$name = "";
		foreach ($game->name as $namepart) {
			$name .= $namepart . " ";
		}
		
	//	echo "  -- " . $name . " - " .$game->thumbnail . "\n"; 
	}

}



echo "INICIO " . date ("d/m/Y H:i:s") . "\n\n";
for ($i = $idInicioBusqueda; $i <= $idFinBusqueda; $i++) {


	if ($elementosProcesados < $elementosXConsulta) {

		$parametrosConsulta .= $i . ",";
		$elementosProcesados++;
		$procesadoBucle = false;
	}
	else {
		$urlConsulta = $urlAPI . $parametrosConsulta;
//		echo strlen ($urlConsulta) . " - " . $urlConsulta . "\n";
		$xmlContent = file_get_contents_curl ($urlConsulta);
		getDataGames ($xmlContent);
		
		$parametrosConsulta = "";
		$elementosProcesados = 0;
		$procesadoBucle = true;
	}
	


}

var_dump ($procesadoBucle);
if (!$procesadoBucle) {

	echo "** Procesar fuera de bucle \n\n";
	$urlConsulta = $urlAPI . $parametrosConsulta;
	$xmlContent = file_get_contents_curl ($urlConsulta);
	getDataGames ($xmlContent);
}


echo "FIN " . date ("d/m/Y H:i:s") . "\n\n";



?>
