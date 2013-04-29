<script>
$(document).ready(function() {
		var itemId =<?php echo "'".$game_id."'"; ?>;
		$("#userRated").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
		$.get('<?php echo site_url('juego/getuserrating/'.$game_id); ?>', function(data) {
			$('#userRated').html(data);
		});

		$("#comunityReviews").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
		$.get('<?php echo site_url('comments/getallreviews/'.$game_id); ?>', function(data) {
			$('#comunityReviews').html(data);
		});
		
});

</script>
<script type="text/javascript">

	/* Abrir ventana modal resena*/
	function modalReview(display,idA,idB)
	{

		if (display == 'block') {

			$("#modalReview").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax			
			$.get('<?php echo site_url('users_interface/setreview/'.$game_id); ?>', function(data) {	
				$("#modalReview").html (data);
			});

			
		}

		toogle (display, idA);
		toogle (display, idB);		
	}

	function toogle (display, element) {
		
		document.getElementById(element).style.display=display;
	}

</script>				

			<article class="item clearfix">
				<div class="imagecol">
				 <img src="<?php echo $game_thumbnail; ?>" alt="<?php echo stripslashes($game_name);?>">
				 <div id="userRated"></div>	
				</div>
				
				<div class="datoscol">
					
					<section class="infoItem">
						<h1><?php echo stripslashes($game_name); ?></h1>
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
						 
						<div class="labelitemleft"><?php echo lang("item_disenador");?>: </div><div class="textitemleft"><?php echo implode (', ', $autor); ?></div>
						<div class="labelitemleft">Ilustrador: </div><div class="textitemleft"><?php echo implode (', ', $artist); ?></div>
						<div class="labelitemleft">N&uacute;mero Jugadores: </div><div class="textitemleft"><?php echo $game_minplayers . " - " . $game_maxplayers; ?></div>
						<div class="labelitemleft">Edad recomendada: </div><div class="textitemleft"><?php echo $game_age; ?></div>
						<div class="labelitemleft">Duraci&oacute;n: </div><div class="textitemleft"><?php echo $game_duration; ?> minutos</div>
						<div class="labelitemleft">Dependencia del idioma: </div><div class="textitemleft"><?php echo $language['language_name']; ?></div>
						<div class="labelitemleft">A&ntilde;o de publicac&oacute;n: </div><div class="textitemleft"><?php echo $game_yearpub; ?></div>
						<div class="labelitemleft">Mec&aacute;nicas: </div><div class="textitemleft"><?php echo implode (', ', $mechanics); ?></div>
						<div class="labelitemleft">Categorias: </div><div class="textitemleft"><?php echo implode (', ', $category); ?></div>
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
			<div id="comunityReviews"></div>	

						
			</section>
			
			
			<section class="colder clearfix">
			<h2>Otros datos</h2>			
			</section>
			
				
				
			
<div id="modal" style="display:none">
	<div id="ventana" class="contenedor" style="display:none">
		<span id="modalReview"></span>
		<a href="#close" title="Cerrar" onclick="modalReview('none','modal','ventana'); return false;" >Close</a>
	</div>
</div>


			
