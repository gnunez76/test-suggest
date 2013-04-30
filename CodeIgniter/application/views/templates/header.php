<?php

	$this->load->helper('url');
	$this->load->helper('cookie');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="">
		
  		<link href="/assets/css/estilos.css" rel="stylesheet">
  		
        <link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
		<script src="/assets/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script>
	
        <link href="/assets/css/rating-stars/jquery.rating.css" rel="stylesheet">     
        <script src="/assets/js/rating-stars/jquery.rating.pack.js"></script>
        <script src="/assets/js/rating-stars/register_rating.js"></script>
        
        
        <script type="text/javascript" src="/assets/js/jquery.form.js"></script> 
		<title><?php echo stripslashes($game_name); ?></title>

<!-- Buscador predictivo -->
<script>

       $(function() {

                $( "#autocomplete" ).autocomplete({
                        source: "<?php echo site_url('juego/buscador/')?>",
//                        search: function (event, ui) {
//                                $("#autocomplete").html("cargando... ");
//                        },
                        response: function ( event, ui ) {
				for (j=0; j<ui.content.length; j++) {

					$resultAux = ui.content[j].value.split('|');
					ui.content[j].value=$resultAux[0];
					ui.content[j].label=$resultAux[1];
						
				}
                                $("#autocomplete").html("");
                        },
			select: function( event, ui ) { 
				document.location.href=ui.item.value; 
                                $("#autocomplete").value('');
			}
                        //close: function( event, ui ) { searchSelection();  }
                });

        });
</script>
		
<!-- LeerMas -->
<script type="text/javascript">

function leerMas (tagVisible, tagOculto, tagMore) {

	
	if($("#"+tagMore).text() == 'Leer mas...') {
		$("#"+tagVisible).hide();
		$("#"+tagOculto).show();
		$("#"+tagMore).remove();
		//$("#"+tagMore).text('Leer menos...');
	} else {
		$("#"+tagVisible).show();
		$("#"+tagOculto).hide();
		$("#"+tagMore).text('Leer mas...');
	}

//	return true;
	
}
</script>
				
<script type="text/javascript">  
/*
	// esperamos que el DOM cargue
	$(document).ready(function() { 
		// definimos las opciones del plugin AJAX FORM
		var opciones= {
			beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
			success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
		};
	
		//asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
	//	$('#reviewForm').ajaxForm() ; 
		$('#reviewForm').ajaxForm(opciones) ; 
	
		//lugar donde defino las funciones que utilizo dentro de "opciones"
		function mostrarLoader(){
			$("#comments").append ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax
		};
	
	
		function mostrarRespuesta (responseText){
			document.location.href='#close';
	//		alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
	//		$("#comments").html('Gracias por enviar tu review <br><div class="botonreview"><a href="#close" title="Close">CERRAR</a></div>'); // Hago desaparecer el loader de ajax
	//		$("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
		};
	
	}); 
*/
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
var userAvatar = null;
//var parametrosCookie
for (var nBucle=0; nBucle<ckArr.length; nBucle++) 
{
	var aCookie = ckArr[nBucle].split("="); 
	// Comprobamos que la cookie que necesitamos est? creada 
	if (aCookie[0] == "SI_UserName") 
	{
		var parametrosCookie = unescape(aCookie[1]); 
		userInfo = utf8_decode(parametrosCookie.split("|")[0].replace('+',' '));
	}
	
	else if (aCookie[0] == "SI_Avatar") 
	{
		var parametrosCookie = unescape(aCookie[1]); 
		userAvatar = parametrosCookie.split("|")[0].replace('+',' ');
	}

}

</script>
		
	</head>
	
	<body>
	


	
	
	
	
	
	
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
					  cadRegistro += '<li class="userimg"><img src="'+userAvatar+'" alt=""></li>';
					} 
					document.write(cadRegistro);
				</script>
				</ul>
				
				<ul class="sitenav">
					<li><a class="navlink" href="/">Home</a></li>
					 			
					<!-- 				
					<li><a class="navlink" href="/">Home</a></li>				
					<li><a class="navlink" href="/">Home</a></li>
					 -->					
				</ul>
			
			</nav>

			<div style='margin-top: 0; margin: 0 auto;'>
			<label><span>Buscar:</span>
			<input type="search" placeholder="Busca un juego..." autocomplete="off" id="autocomplete" name="q" dir="ltr" spellcheck="false" style="width: 300px; margin-top:-15px;"></label>
			</div>
			


			
		</header>
		
		<div class="page">