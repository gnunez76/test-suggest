<script>
$(document).ready(function() {
		itemId =<?php echo "'".$game_id."'"; ?>;
		$.get('/juego/getuserrating/'+itemId, function(data) {
			$('#userRated').html(data);
		});
		
});
</script>

<header>
<h3>Buscador y Ficha PROTO</h3>
		</header>
        <nav>


	<div>
<input id="autocomplete" title="type" style="border: 1px dashed #CBC8BE; border-radius: 4px 4px 4px 4px; color: #4A3D2E; font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif; font-size: 1.1em; padding: 8px; width: 240px;"/>
	</div>
<!--
            <ul>
                <li><a href="#">inicio</a></li>
                <li><a href="#">blog</a></li>
                <li><a href="#">vídeos</a></li>
            </ul>
-->
        </nav>
	<section>

    	 <article>

        	 <header>
        	 	<span><h3><?php echo $game_name; ?></h3></span>
        	 	<span style="padding-left: 5px;">
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
				</span>
        	 	
        	 </header>

			<div style="float:left;">

				<div><img src="<?php echo 'http://cf.geekdo-images.com/images/'.$game_thumbnail;    ?>" /></div>


				
<div id="userRated">
</div>	
				
				
			</div>
			<div style="float:left; padding-left: 25px;">
				<p><div style="float:left;"><strong>Autor: </strong></div><div style="float:left; padding-left: 5px;"><?php echo implode ('<br/>', $autor); ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Diseñador: </strong></div><div style="float:left; padding-top: 5px; padding-left: 5px;"><?php echo implode ('<br/>', $artist); ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Ano publicacion: </strong> <?php echo $game_yearpub; ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Editorial: </strong></div><div style="float:left; padding-top: 5px; padding-left: 5px;"><?php echo implode ('<br/>', $editorial); ?></div></p>
			</div>	
			
		        <div style="clear:left; padding-top: 10px;"><p><?php echo $game_description; ?></p>
			</div>

    	  </article>              

	 </section>
