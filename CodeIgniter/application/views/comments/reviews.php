<script type="text/javascript">
$(document).ready(function() {
	$('.comments-star').rating({
		required: true
	});
});

function loadComments (commentId) {

	$("#commentsreview_"+commentId).html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
	$.get('<?php echo site_url('comments/getReviewsComments/'.$itemId); ?>/'+commentId, function(data) {
		$("#commentsreview_"+commentId).html(data);
		return false;
	});		

}


</script>

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
							echo '<input name="rating-item'.$review['comment_id'].'" type="radio" class="comments-star" value="'.$ratio.'" checked="checked" disabled="disabled" />';
						}
						else {
							echo '<input name="rating-item'.$review['comment_id'].'" type="radio" class="comments-star" value="'.$i.'" disabled="disabled" />';
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
							$.get('<?php echo site_url('comments/getlikebutton'); ?>/'+commentId, function(data) {
								$("#blike"+commentId).html(data);
							});		
					});


					
				</script>
				<div class="socialcomments">
					<span id="blike<?php echo $review['comment_id']; ?>"></span>
					<!--  div class="nummegusta"><?php echo $review['comment_votes']; ?> me gusta</div -->
					<div class="nummegusta"><a href="#" onclick="loadComments('<?php echo $review['comment_id']?>'); return false;"><?php echo $review["hijos"]["numComments"]; ?> comentarios</a></div>
					
				</div>
				
			</div>
		</div>
	</div>
	<div id="commentsreview_<?php echo $review['comment_id']?>"></div>
	
					
					
	<?php endforeach; ?>
	<?php endif; ?>
</div>

