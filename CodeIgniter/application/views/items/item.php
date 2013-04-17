<script>
$(document).ready(function() {
		var itemId =<?php echo "'".$game_id."'"; ?>;
		$("#userRated").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
		$.get('/juego/getuserrating/'+itemId, function(data) {
			$('#userRated').html(data);
		});

		$("#comunityReviews").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
		$.get('/comments/getallreviews/'+itemId, function(data) {
			$('#comunityReviews').html(data);
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
		if (idB != null) {
			document.getElementById(idB).style.display=display;
		}
	}

</script>				

			<article class="item clearfix">
				<div class="imagecol">
				 <img src="<?php echo $game_thumbnail; ?>" alt="<?php echo $game_name;?>">
				 <div id="userRated"></div>	
				</div>
				
				<div class="datoscol">
					
					<section class="infoItem">
						<h1><?php echo $game_name; ?></h1>
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
			<div id="comunityReviews"></div>	

						
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


			
