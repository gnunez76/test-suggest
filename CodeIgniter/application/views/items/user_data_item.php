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
<span>Tus datos</span>
<div style='margin-top: 10px; border: 1px dashed #CBC8BE; height: 100px; border-radius: 4px 4px 4px 4px; padding: 5px 5px 5px 5px;'>
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