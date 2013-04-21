<script type="text/javascript">
$(document).ready(function() {
	$('.star').rating({
		required: true,
		callback: function(value, link) {
		            	
			aValue = value.split('|');
			$.get('/juego/rateitem/'+<?php echo $itemId; ?>+'/'+aValue[0]);
		
		}
	});
});
</script>

<?php if  (isset ($userReview['comment_id'])): ?>
<div class="botonreview"><a href="#" onclick="modalReview('block','modal','ventana');return false;">EDITA TU RESE&Ntilde;A</a></div>
<?php else: ?>
<div class="botonreview"><a href="#" onclick="modalReview('block','modal','ventana');return false;">A&Ntilde;ADE TU RESE&Ntilde;A</a></div>
<?php endif; ?>
<span class="label10">Tu puntuaci&oacute;n</span>

<?php if (isset($user_profile)): ?>
<div class="userrated">
	<?php  
	
		for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {

			if ($i == $rateGame) {
				echo '<input name="rating" type="radio" class="star" value="'.$i.'" checked="checked" />';
			}
			else {
				echo '<input name="rating" type="radio" class="star" value="'.$i.'" />';
			}
		}
		
	?>
</div>
<?php else: ?>
<div class="userrated">
	<?php  
	
		for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {

			echo '<input name="rating" type="radio" class="star" value="'.$i.'" disabled="disabled" />';
		}
		
	?>
</div>
<?php endif; ?>
