<!-- comentarios a la review -->
<?php $this->load->helper('url'); ?>

<script type="text/javascript">  

	// esperamos que el DOM cargue
	$(document).ready(function() { 
		// definimos las opciones del plugin AJAX FORM
		var opciones= {
			beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
			success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
		};
	
		//asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
		$('#commentForm_<?php echo $commentId; ?>').ajaxForm(opciones) ; 
	//	$('#reviewForm').ajaxForm(opciones) ; 
	
		//lugar donde defino las funciones que utilizo dentro de "opciones"
		function mostrarLoader(){
			
			$("#ajax_loader_<?php echo $commentId; ?>").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax
		};
	
	
		function mostrarRespuesta (responseText){
	/* Refresca comentarios */
	
			$("#commentsreview_<?php echo $commentId; ?>").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
			$.get('<?php echo site_url('comments/getReviewsComments/'.$itemId.'/'.$commentId); ?>', function(data) {
				$("#commentsreview_<?php echo $commentId; ?>").html(data);
			});			
			
	//		alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
	//		$("#ajax_loader_<?php echo $commentId; ?>").html("Gracias por participar"); // Hago desaparecer el loader de ajax
	//		$("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
		};
	
	}); 
 
</script>  

<div class="commenttoreview" id="commenttoreview_<?php echo $commentId; ?>">
	<?php if ($hijos): ?>
	<?php foreach ($hijos as $hijo): ?>
	<div id="ctr_comments">
		<div class="crt_commentimg"><img src="<?php echo $hijo['usr_photoURL']; ?>"></div>
		<div class="crt_reviewbody">
			<div class="crt_username"><a href=""><?php echo $hijo['usr_name']; ?></a></div>
			<div class="crt_cuerporeview">	
				<span class="summary" id="complete_<?php echo $hijo['comment_id']?>">	
					<p><?php echo nl2br($hijo['comment_text']); ?></p>
				</span>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php endforeach; ?>
	<?php endif; ?>
	<div id="ajax_loader_<?php echo $commentId; ?>">
		<form method="post" action="<?php echo site_url('comments/insertreviewcomment/'.$itemId); ?>" id="commentForm_<?php echo $commentId; ?>">                    
            <textarea name="texto" placeholder="Comenta la rese&ntilde;a" required="true"></textarea>
			<input type="hidden" name="parentid" value="<?php echo $commentId; ?>">    
			<input id="submit" name="submit" type="submit" value="Comentar">
		</form>
	</div>
</div>