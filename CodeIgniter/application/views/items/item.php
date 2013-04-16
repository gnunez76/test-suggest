<script>
$(document).ready(function() {
		var itemId =<?php echo "'".$game_id."'"; ?>;
		$("#userRated").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
		$.get('/juego/getuserrating/'+itemId, function(data) {
			$('#userRated').html(data);
		});


	/*	
		itemId =<?php echo "'".$game_id."'"; ?>;
		$.get('/comments/getitemcomments/'+itemId, function(data) {
			$('#comments').html(data);
		});
	*/	
		
});

</script>
<script type="text/javascript">

	/* Abrir ventana modal resena*/
	function toogle(display,idA,idB)
	{

		if (display == 'block') {

			$("#modalReview").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax			
			$.get('/users_interface/setreview/<?php echo $game_id?>', function(data) {	
				$("#modalReview").html (data);
			});

			
		}
		
		document.getElementById(idA).style.display=display;
		document.getElementById(idB).style.display=display;
	}

</script>				

			<article class="item clearfix">
				<div class="imagecol">
				 <img src="<?php #echo $game_thumbnail; ?>" alt="<?php echo $game_name;?>">
				 <div id="userRated"></div>	
				</div>
				
				<div class="datoscol">
					
					<section class="infoItem">
						<h1><?php #echo $game_name; ?></h1>
						<div class="itemrates">
							<?php 
								$ratio = 0; 
								if ($game_totalRating) {
									$ratio = number_format($game_totalRating/$game_totalVotes, 1);
								}
								
								for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {
		
									if ($i == round($ratio)) {
										echo '<input name="rating-item" type="radio" class="auto-submit-star" value="'.$ratio.'" checked="checked" disabled="disabled" />';
									}
									else {
										echo '<input name="rating-item" type="radio" class="auto-submit-star" value="'.$i.'" disabled="disabled" />';
									}
								}
							?>
							<span class="puntos">
								<?php 
									if ($ratio) {
										echo $ratio."/".SI_ITEM_RATING_AVAILABE;
									}
									else {
										echo "-/".SI_ITEM_RATING_AVAILABE;	
									}
								?>
							</span>
						</div>						
						 
						<div class="labelitemleft">Autor: </div><div class="textitemleft"><?php echo implode (', ', $autor); ?></div>
						<div class="labelitemleft">Ilustrador: </div><div class="textitemleft"><?php echo implode (', ', $artist); ?></div>
						<div class="labelitemleft">A&ntilde;o de publicac&oacute;n: </div><div class="textitemleft"><?php echo $game_yearpub; ?></div>
						<div class="labelitemleft">Editorial: </div><div class="textitemleft"><?php echo implode (', ', $editorial); ?></div>
						
						<div style="float: left; clear:left;">
						<p><?php echo $game_description; ?></p>
						</div>

					</section>
							
				</div>
			</article>
<!-- 
			<section class="userdata clearfix">
			<h2>My Review</h2>
			</section>
			
			<section class="userdata clearfix">
			<h2>Friends Review</h2>			
			</section>
 -->

			<!-- TODAS LAS REVIEWS -->
			<section class="userdata clearfix">
			<h2>Comunity Review</h2>
				<div class="allComments">
	
					<?php if ($reviews): ?>
					<?php foreach ($reviews as $review): ?>
					<div class="review">
						<div class="commentimg"><img src="<?php echo $review['usr_photoURL']; ?>" width="30" height="30" /></div>
						<div class="reviewbody">
							<h3 class="tituloreview">REVIEW: <?php echo $review['comment_title']; ?></h3>
							<div class="fechareview"><?php echo $review['fecha']; ?></div>
							<div class="username"><a href=""><?php echo $review['usr_name']; ?></a> puntu&oacute; </div>
							<div class="itemratesreview">
								<?php 
									$ratio = 0; 
									if ($review['game_rating']) {
										$ratio = $review['game_rating'];
									}
									
									for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {
			
										if ($i == round($ratio)) {
											echo '<input name="rating-item'.$review['comment_id'].'" type="radio" class="auto-submit-star" value="'.$ratio.'" checked="checked" disabled="disabled" />';
										}
										else {
											echo '<input name="rating-item'.$review['comment_id'].'" type="radio" class="auto-submit-star" value="'.$i.'" disabled="disabled" />';
										}
									}
								?>
								<span class="puntos">
									<?php 
										if ($ratio) {
											echo $ratio."/".SI_ITEM_RATING_AVAILABE;
										}
										else {
											echo "-/".SI_ITEM_RATING_AVAILABE;	
										}
									?>
								</span>
							</div>						
								
							<div class="cuerporeview">
								<span class="summary" id="summary_<?php echo $review['comment_id']?>">
									<p><?php echo $review['summary']."... "; ?></p>
								</span>
								<span class="complete" id="complete_<?php echo $review['comment_id']?>">	
									<p><?php echo nl2br($review['comment_text']); ?></p>
								</span>
								<span class="more" >
									<a href="#" id="more_<?php echo $review['comment_id']?>" onclick="javascript:leerMas('summary_<?php echo $review['comment_id'] ?>', 'complete_<?php echo $review['comment_id']?>', 'more_<?php echo $review['comment_id']?>'); return false;">Leer mas...</a>
								</span>
								<script>
								
									$(document).ready(function() {
											var commentId=<?php echo "'".$review['comment_id']."'"; ?>;
											$("#blike"+commentId).html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
											$.get('/comments/getlikebutton/'+commentId, function(data) {
												$("#blike"+commentId).html(data);
											});		
									});
									
								</script>
								<div class="socialcomments">
									<span id="blike<?php echo $review['comment_id']; ?>"></span>
									<!--  div class="nummegusta"><?php echo $review['comment_votes']; ?> me gusta</div -->
									<div class="nummegusta"><?php echo count($review["hijos"]); ?> comentarios</div>
									<div class="mun"></div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- comentarios a la review -->
					<script type="text/javascript">  

						// esperamos que el DOM cargue
						$(document).ready(function() { 
							// definimos las opciones del plugin AJAX FORM
							var opciones= {
								beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
								success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
							};
						
							//asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
							$('#commentForm_<?php echo $review["comment_id"]?>').ajaxForm(opciones) ; 
						//	$('#reviewForm').ajaxForm(opciones) ; 
						
							//lugar donde defino las funciones que utilizo dentro de "opciones"
							function mostrarLoader(){
								
								$("#ajax_loader_<?php echo $review['comment_id']?>").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax
							};
						
						
							function mostrarRespuesta (responseText){
						//		alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
								$("#ajax_loader_<?php echo $review['comment_id']?>").html("Gracias por participar"); // Hago desaparecer el loader de ajax
						//		$("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
							};
						
						}); 
					 
					</script>  
					
					<div class="commenttoreview">
						<?php if ($review["hijos"]): ?>
						<?php foreach ($review["hijos"] as $hijo): ?>
						<div id="ctr_comments">
							<div class="crt_commentimg"><img src="<?php echo $hijo['usr_photoURL']; ?>"></div>
							<div class="crt_reviewbody">
								<div class="crt_username"><a href=""><?php echo $hijo['usr_name']; ?></a></div>
								<div class="crt_cuerporeview">	
									<span class="summary" id="summary_<?php echo $hijo['comment_id']?>">
										<p><?php echo $hijo['summary']; ?></p>
									</span>
									<span class="complete" id="complete_<?php echo $hijo['comment_id']?>">	
										<p><?php echo nl2br($hijo['comment_text']); ?></p>
									</span>
									<span class="more" >
										<a href="#" id="more_<?php echo $hijo['comment_id']?>" onclick="javascript:leerMas('summary_<?php echo $hijo['comment_id'] ?>', 'complete_<?php echo $hijo['comment_id']?>', 'more_<?php echo $hijo['comment_id']?>'); return false;">Leer mas...</a>
									</span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<?php endforeach; ?>
						<?php endif; ?>
						<div id="ajax_loader_<?php echo $review['comment_id']?>">
							<form method="post" action="/comments/insertreviewcomment/<?php echo $game_id?>" id="commentForm_<?php echo $review['comment_id']; ?>">
	                    
	            				<textarea name="texto" placeholder="Comenta la review" required="true"></textarea>
	            				<input type="hidden" name="parentid" value="<?php echo $review['comment_id']; ?>">
	                
	            				<input id="submit" name="submit" type="submit" value="Submit">
	        
								
	        				</form>
        				</div>
					</div>
					
					
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				

						
			</section>
			
			
			<section class="colder clearfix">
			<h2>Otros datos</h2>			
			</section>
			
				
				
			
<div id="modal" style="display:none">
	<div id="ventana" class="contenedor" style="display:none">
		<span id="modalReview"></span>
		<a href="#close" title="Cerrar" onclick="toogle('none','modal','ventana'); return false;" >Close</a>
	</div>
</div>


			