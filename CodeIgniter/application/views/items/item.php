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

				<div><img src="<?php echo $game_thumbnail;    ?>" /></div>


				
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

<section>
<div id="comments">
        <form method="post" action="/comments/insertitemcomment/<?php echo $game_id?>" id="reviewForm">
        
            <label>T&iacute;tulo*</label>
            <input name="titulo" placeholder="Título de tu review" required="true" />
            
            <label>Texto*</label>
            <textarea name="texto" placeholder="Danos tu opinión" required="true"></textarea>
            
            
            <input id="submit" name="submit" type="submit" value="Submit">
        
			<div id="ajax_loader"></div>
        </form>
</div>

<div class="allComments">

	<?php if ($reviews): ?>
	<?php foreach ($reviews as $review): ?>
	<div>
		<div><img src="<?php echo $review['usr_photoURL']; ?>" /> - <?php echo $review['usr_name']; ?></div>
		<h3><?php echo $review['comment_title']; ?></h3><span><?php echo $review['fecha']; ?></span>
		<p><?php echo $review['comment_text']; ?></p>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
</div>


</section>

