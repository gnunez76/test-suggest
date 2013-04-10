<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="">
		
  		<link href="/assets/css/estilos.css" rel="stylesheet">
  		
        <!--  link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet" -->
		<script src="/assets/js/jquery-1.9.1.min.js"></script>
        <!--  script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script -->
	
        <link href="/assets/css/rating-stars/jquery.rating.css" rel="stylesheet">     
        <script src="/assets/js/rating-stars/jquery.rating.pack.js"></script>
        <script src="/assets/js/rating-stars/register_rating.js"></script>
        
        
        <script type="text/javascript" src="/assets/js/jquery.form.js"></script> 
		<title><?php echo $game_name; ?></title>
		
		
<script type="text/javascript">  

	// esperamos que el DOM cargue
	$(document).ready(function() { 
		// definimos las opciones del plugin AJAX FORM
	/*	var opciones= {
	//		beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
			success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
		};
	*/
		//asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
		$('#reviewForm').ajaxForm() ; 
	//	$('#reviewForm').ajaxForm(opciones) ; 
	
		//lugar donde defino las funciones que utilizo dentro de "opciones"
	/*	function mostrarLoader(){
			$(#loader_gif).fadeIn("slow"); //muestro el loader de ajax
		};
	*/
	/*
		function mostrarRespuesta (responseText){
			alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
	//		$("#loader_gif").fadeOut("slow"); // Hago desaparecer el loader de ajax
	//		$("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
		};
	*/
	}); 
 
</script>  
        
		
<script>

function utf8_decode ( str_data ) {  
    // Converts a UTF-8 encoded string to ISO-8859-1    
    //   
    // version: 810.1317  
    // discuss at: http://phpjs.org/functions/utf8_decode  
    // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)  
    // +      input by: Aman Gupta  
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)  
    // +   improved by: Norman "zEh" Fuchs  
    // +   bugfixed by: hitwork  
    // +   bugfixed by: Onno Marsman  
    // *     example 1: utf8_decode('Kevin van Zonneveld');  
    // *     returns 1: 'Kevin van Zonneveld'  
    var tmp_arr = [], i = ac = c1 = c2 = c3 = 0;  
  
    str_data += '';  
  
    while ( i < str_data.length ) {  
        c1 = str_data.charCodeAt(i);  
        if (c1 < 128) {  
            tmp_arr[ac++] = String.fromCharCode(c1);  
            i++;  
        } else if ((c1 > 191) && (c1 < 224)) {  
            c2 = str_data.charCodeAt(i+1);  
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));  
            i += 2;  
        } else {  
            c2 = str_data.charCodeAt(i+1);  
            c3 = str_data.charCodeAt(i+2);  
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));  
            i += 3;  
        }  
    }  
  
    return tmp_arr.join('');  
}  

var ckArr = document.cookie.split("; "); 
var userInfo = null; 
for (var nBucle=0; nBucle<ckArr.length; nBucle++) 
{
	var aCookie = ckArr[nBucle].split("="); 
	// Comprobamos que la cookie que necesitamos est? creada 
	if (aCookie[0] == "SI_UserName") 
	{
		var parametrosCookie = unescape(aCookie[1]); 
		userInfo = utf8_decode(parametrosCookie.split("|")[0].replace('+',' '));
	}
}
</script>
		
	</head>
	
	<body>
	
	
<?php

	$this->load->helper('url');
	$this->load->helper('cookie');
?>


	
	
	
	
	
	
		<header class="siteheader">

			<nav class="navtop">
				<ul class="userlogin">
				
<script>
var cadRegistro = '';
if (userInfo == null) 
{
  cadRegistro += '<li>Puedes logarte con: </li>';
  cadRegistro += <?php echo "'<li>".anchor('hauth/login/Google?backURL='.current_url(), '<img src="/assets/images/top-google.png" alt="Google">', array ('title' => 'Login con Google'))."</li>'"; ?>;
  cadRegistro += <?php echo "'<li>".anchor('hauth/login/Facebook?backURL='.current_url(), '<img src="/assets/images/top-facebook.png" alt="Facebook">', array ('title' => 'Login con Facebook'))."</li>'"; ?>;
  cadRegistro += <?php echo "'<li>".anchor('hauth/login/Twitter?backURL='.current_url(), '<img src="/assets/images/top-twitter.png" alt="Twitter">', array ('title' => 'Login con Twitter'))."</li>'"; ?>;
} 
else 
{
  cadRegistro += '<li>Hola '+userInfo+'</li>';
  cadRegistro += <?php echo "'<li>".anchor('hauth/logout/'.get_cookie('SI_Provider').'?backURL='.current_url(), 'Desconectar', array ('title', 'Desconectar'))."</li>'";  ?>;
  cadRegistro += '<li class="userimg"><img src="http://a0.twimg.com/profile_images/1487874120/casco_99_ajustada_normal.jpg" alt=""></li>';
} 
document.write(cadRegistro);
</script>
				</ul>
				
				<ul class="sitenav">
					<li><a class="navlink" href="/">Home</a></li>
					<!-- 			
					<li><a class="navlink" href="/">Home</a></li>				
					<li><a class="navlink" href="/">Home</a></li>				
					<li><a class="navlink" href="/">Home</a></li>
					 -->					
				</ul>
			
			</nav>

	

<!--			
			<div id="search_form" style="display: none;" class="subheader search">
				<div class="search">
					<form role="search" id="cse-search-box" action="/en/search">
						<img width="29" height="29" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB0AAAAdCAYAAABWk2cPAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjM0OTMyQTREN0FEMTFFMEJDMEZDMjAwMjNDNjc0MDciIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjM0OTMyQTVEN0FEMTFFMEJDMEZDMjAwMjNDNjc0MDciPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGMzQ5MzJBMkQ3QUQxMUUwQkMwRkMyMDAyM0M2NzQwNyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGMzQ5MzJBM0Q3QUQxMUUwQkMwRkMyMDAyM0M2NzQwNyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ps3igWgAAAFzSURBVHjazJfPSsNAEMZ3EygoBAoepD0VBA
+Cp76AvoCvkWfK0+gLeBI8FISc2lMhsFBBCPGbMKGrZP/qNh342LKdzI/Z7OxOpPCwruvmGEgX0OWIywH6hBopZeOKJx2wJYYraCb87QvaA74NggJG2dwEwsbgH4AfnFAAKbOV+D+rAd4boQmAo+BMAxaJgGQrjn+EYiJPCNTBuZ7ptWXTrKHCM3DB/mM2Y46QTL+HcoPzM7SDSkg5gBW0gB4NPi30lnHR55ZgJQeqLBnrwNISizjzAWqzjQP8G7hxxOuhPu/LBA4F9s9kjqW1gZcRwH6JaSOtA7f+rZatCgT+PBxOaVlkllRCTzxWPB8EbSOAtKRbHkPBbeYoeBNweEZFgBVBm0igiAQ3kxyDUmtLFgbHB+jV8zUMB/6L4f8dtTFSu9ru/tie+LQv74D2G0nQD7rdE5dnzZxjnWJCJQTXHP9MGrPJWtDJmu3knxUIePJb5luAAQDWPZwf40bkcAAAAABJRU5ErkJggg==" id="search_hide">
						<label><span>Search:</span><input type="search" placeholder="HTML5 Rocks" autocomplete="off" id="q" name="q" dir="ltr" spellcheck="false" style="outline: medium none;"></label>
					</form>
				</div>
			</div>
-->			
		</header>
		
		<div class="page">