
<style>

@charset "utf-8";


form {
	width:600px;
/*	margin:0 auto; */
}


label {
	display:block;
	margin-top:20px;
	letter-spacing:2px;
}


input, textarea {
	width:439px;
/*
	height:27px;
	background:#efefef;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
*/
	border:1px solid #dedede;
	padding:10px;
	margin-top:3px;
	font-size:0.9em;
	color:#3a3a3a;
}

input:focus, textarea:focus {
	border:1px solid #97d6eb;
}

textarea {
	height:213px;
	width:600px;
	font-family:Arial, Helvetica, sans-serif;
}

#submit {
	width:127px;
	height:38px;
	border:none;
	margin-top:20px;
	cursor:pointer;
}

#submit:hover {
	opacity:0.9;
}


</style>

<!--

<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>How to make a Contact Form using HTML5, CSS3 and PHP - A Tangled in Design Demo</title>


</head>

<body>

	<header class="body">
    	
        <h1>Get in Touch</h1>
        
    </header>
	
    <section class="body">
    
    	    
-->

<!-- 
<script type="text/javascript" src="/assets/js/jquery-1.9.1.min.js"></script>  
-->
 
  
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


        <form method="post" action="<?php site_url('comments/insertitemcomment/'); ?>" id="reviewForm">
        
            <label>T&iacute;tulo*</label>
            <input name="titulo" placeholder="Título de tu review" required="true" />
            
            <label>Texto*</label>
            <textarea name="texto" placeholder="Danos tu opinión" required="true"></textarea>
            
            
            <input id="submit" name="submit" type="submit" value="Submit">
        
			<div id="ajax_loader"></div>
        </form>
  <!--      

<form id="myForm" action="contacto.php" method="post" style="height:200px;"> 
    <label>Nombre:</label> <input type="text" name="name" /> 
    <label>Mensaje:</label> <textarea name="mensaje"></textarea> 
    <input type="submit" value="Enviar" /> <div id="ajax_loader"><img id="loader_gif" src="loader.gif" style=" display:none;"/></div>
</form>

    </section>
    
    <footer class="body">
    	<a href="http://tangledindesign.com/blog"><img src="images/tangled-logo.jpg" alt="A Tangled in Design Demo"></a>
    </footer>

</body>
</html>
-->
