<!-- ELIMINAR CSS -->
<link href="/assets/css/estilos.css" rel="stylesheet">
<link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
<link href="/assets/css/rating-stars/jquery.rating.css" rel="stylesheet">
<!-- /ELIMNAR CSS -->
<!-- ELIMINAR JS -->    
<script src="/assets/js/jquery-1.9.1.min.js"></script>
<script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="/assets/js/rating-stars/jquery.rating.pack.js"></script>
<script type="text/javascript" src="/assets/js/jquery.form.js"></script> 
<!-- /ELIMINAR JS -->

<script type="text/javascript">
$(document).ready(function() {
	$('.star-review').rating({
		required: true,
		callback: function(value, link) {
		            	
			aValue = value.split('|');
			$.get('/juego/rateitem/'+<?php echo $itemId; ?>+'/'+aValue[0]);
		
		}
	});
});
</script>


<script type="text/javascript">  

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
 
</script>  
        
<script>

	function borrar (field, label) {

		$("#"+field).remove();
		$("#"+label).remove();
		return false;
	}

       $(function() {

                $( "#autocompletegame" ).autocomplete({
                        source: "/juego/buscador/",
//                        search: function (event, ui) {
//                                $("#autocomplete").html("cargando... ");
//                        },
                        response: function ( event, ui ) {
							for (j=0; j<ui.content.length; j++) {

							$resultAux = ui.content[j].value.split('|');
							ui.content[j].value=$resultAux[0];
							ui.content[j].label=$resultAux[1];
						
							}
                            $("#autocompletegame").html("");
                        },
						select: function( event, ui ) { 
							var itemAux = ui.item.value.split('/');
							$("#juegosrelacionados").append('<input type="hidden" name="juegos['+itemAux[5]+']" id="juegos_'+itemAux[5]+'" value="'+itemAux[5]+'">')
							$("#juegosrelacionados").append('<div style="margin:5px;" id="label_juegos_'+itemAux[5]+'">'+ui.item.label+'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(&#039'+'juegos_'+itemAux[5]+'&#039, &#039'+'label_juegos_'+itemAux[5]+'&#039); return false;">Borrar</a></div>');
							$("#autocompletegame").val('');
						},
	                    close: function( event, ui ) { 
	                        $("#autocompletegame").val('');
	                          
	                    }
                });

        });


       $(function() {

           $( "#autocompleteautor" ).autocomplete({
                   	source: "/juego/autor/",
//                   search: function (event, ui) {
//                           $("#autocomplete").html("cargando... ");
//                   },
                   	response: function ( event, ui ) {
						for (j=0; j<ui.content.length; j++) {
			
							var $resultAux = ui.content[j].value.split('|');
							ui.content[j].value=$resultAux[0];
							ui.content[j].label=$resultAux[1];
								
						}
						$("#autocompleteautor").html("");
                   	},
					select: function( event, ui ) { 


						var itemAux = ui.item.value.split('/');
						$("#autoresrelacionados").append('<input type="hidden" name="autores['+itemAux[5]+']" id="autores_'+itemAux[5]+'" value="'+itemAux[5]+'">')
						$("#autoresrelacionados").append('<div style="margin:5px;" id="label_autores_'+itemAux[5]+'">'+ui.item.label+'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(&#039'+'autores_'+itemAux[5]+'&#039, &#039'+'label_autores_'+itemAux[5]+'&#039); return false;">Borrar</a></div>');
						$("#autocompleteautor").val('');
						//document.location.href=ui.item.value; 
              			//$("#autocompleteautor").value('');
              			//$("#autocompleteautor").close();
              			//return false;
					},
                    close: function( event, ui ) { 
                        $("#autocompleteautor").val('');
                          
                    }
           });

   });
       
</script>        
		





<?php if ($isLogin): ?>






<div id="comments">



<div class="userrated-form">

	<span class="label10">Tu puntuaci&oacute;n</span>
	<div class="starblock clearfix">
		<?php  
		
			for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {
	
				if ($i == $rateGame) {
					echo '<input name="rating" type="radio" class="star-review" value="'.$i.'" checked="checked" />';
				}
				else {
					echo '<input name="rating" type="radio" class="star-review" value="'.$i.'" />';
				}
			}
			
		?>
	</div>
	
</div>


<form method="post" action="/comments/insertitemcomment/<?php echo $itemId?>" id="reviewForm">


        
<label>T&iacute;tulo*</label>
<input name="titulo" placeholder="Título de tu review..." required="true" />
            
<label>Texto*</label>
<textarea name="texto" placeholder="Danos tu opinión..." required="true"></textarea>

<label>Notas privadas (solo serán visibles por tí)</label>
<textarea name="notas_privadas" placeholder="Escribe unas notas solo par tí..."></textarea>


<label>Relacionar con juego</label>
<input type="search" placeholder="Busca un juego..." autocomplete="off" id="autocompletegame" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
<div class="elementosrelacionados" id="juegosrelacionados">
</div>

<label>Relacionar con autor</label>
<input type="search" placeholder="Busca un autor..." autocomplete="off" id="autocompleteautor" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
<div class="elementosrelacionados" id="autoresrelacionados">
</div>


<div>
<label class="sharetwitter">Compartir en twitter (Pruebas al final del desarrollo)</label>
<input name="sharetwitter" type="checkbox" class="sharetwittercb" />
</div>

           
<input id="submit" name="submit" type="submit" value="Enviar">
        
<div id="ajax_loader"></div>
</form>
</div>
<?php else: ?>

 <?php $this->load->helper('url'); ?>

<div>
<?php echo anchor('hauth/login/Google?backURL='.current_url(), '<img src="/assets/images/top-google.png" alt="Google">', array ('title' => 'Login con Google')); ?>
<?php echo anchor('hauth/login/Facebook?backURL='.current_url(), '<img src="/assets/images/top-facebook.png" alt="Facebook">', array ('title' => 'Login con Facebook')); ?>
<?php echo anchor('hauth/login/Twitter?backURL='.current_url(), '<img src="/assets/images/top-twitter.png" alt="Twitter">', array ('title' => 'Login con Twitter')); ?>
</div>
 


<?php endif; ?>
