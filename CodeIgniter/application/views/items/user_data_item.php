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
<div class="botonreview"><a href="#addreviewmodal">A&Ntilde;ADE TU REVIEW</a></div>
<span class="label10">Tu puntuaci&oacute;n</span>
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