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
				 <a rel="nofollow" itemprop="image" href="/book/photo/13496.A_Game_of_Thrones"><img src="<?php echo $game_thumbnail; ?>" alt="<?php echo $game_name;?>"></a>
				 <div id="userRated"></div>	
				</div>
				
				<div class="datoscol">
					
					<section class="infoItem">
						<h1><?php echo $game_name; ?></h1>
						<div class="itemrates">
							<?php 
								$ratio = 0; 
								if ($game_totalRating) {
									$ratio = $game_totalRating/$game_totalVotes;
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
										echo "0/".SI_ITEM_RATING_AVAILABE;	
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
			<section class="userdata clearfix">
			<h2>My Review</h2>
			</section>
			
			<section class="userdata clearfix">
			<h2>Friends Review</h2>			
			</section>

			<section class="userdata clearfix">
			<h2>Comunity Review</h2>
				<div class="allComments">
	
					<?php if ($reviews): ?>
					<?php foreach ($reviews as $review): ?>
					<div>
						<div><img src="<?php echo $review['usr_photoURL']; ?>" width="40" height="40" /> - <?php echo $review['usr_name']; ?></div>
						<h3><?php echo $review['comment_title']; ?></h3><span><?php echo $review['fecha']; ?></span>
						<p><?php echo $review['comment_text']; ?></p>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
						
			</section>