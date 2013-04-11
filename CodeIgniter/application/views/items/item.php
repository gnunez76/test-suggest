<script>
$(document).ready(function() {
		itemId =<?php echo "'".$game_id."'"; ?>;
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
			<article class="item clearfix">
				<div class="imagecol">
				 <img src="<?php echo $game_thumbnail; ?>" alt="<?php echo $game_name;?>">
				 <div id="userRated"></div>	
				</div>
				
				<div class="datoscol">
					
					<section class="infoItem">
						<h1><?php #echo $game_name; ?></h1>
						<div class="itemrates">
							<?php 
								$ratio = 0; 
								if ($game_totalRating) {
									$ratio = round($game_totalRating/$game_totalVotes);
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
				<div id="addreviewmodal" class="reviewmodal">
					
					<div id="comments">
					<a href="#close" title="Close" class="close">X</a>
				        <form method="post" action="/comments/insertitemcomment/<?php echo $game_id?>" id="reviewForm">
				        
				            <label>T&iacute;tulo*</label>
				            <input name="titulo" placeholder="Título de tu review" required="true" />
				            
				            <label>Texto*</label>
				            <textarea name="texto" placeholder="Danos tu opinión" required="true"></textarea>
				            
				            
				            <input id="submit" name="submit" type="submit" value="Submit">
				        
							<div id="ajax_loader"></div>
				        </form>
					</div>
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
							<p><?php echo $review['comment_text']; ?></p>
						</div>
						</div>
					</div>
					
					<!-- comentarios a la review -->
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
							$('#commentForm_<?php echo $review["comment_id"]?>').ajaxForm() ; 
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
					
					<div class="commenttoreview">
						<?php if ($review["hijos"]): ?>
						<?php foreach ($review["hijos"] as $hijo): ?>
						<div id="ctr_comments">
							<div class="crt_commentimg"><img src="<?php echo $hijo['usr_photoURL']; ?>"></div>
							<div class="crt_reviewbody">
								<div class="crt_username"><a href=""><?php echo $hijo['usr_name']; ?></a></div>
								<div class="crt_cuerporeview">	
									<p><?php echo $hijo['comment_text']; ?></p>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<?php endforeach; ?>
						<?php endif; ?>
						
						<form method="post" action="/comments/insertreviewcomment/<?php echo $game_id?>" id="commentForm_<?php echo $review['comment_id']; ?>">
                    
            				<textarea name="texto" placeholder="Comenta la review" required="true"></textarea>
            				<input type="hidden" name="parentid" value="<?php echo $review['comment_id']; ?>">
                
            				<input id="submit" name="submit" type="submit" value="Submit">
        
							<div id="ajax_loader"></div>
        				</form>
					</div>
					
					
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
				

						
			</section>
			
			
			<section class="colder clearfix">
			<h2>Otros datos</h2>			
			</section>
			