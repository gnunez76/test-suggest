	<div id="dialog-modal" style="display:none;">
	<img src="<?php echo $game_image; ?>">
	<?php 
		if (!ereg('http', $game_image)) {
			$game_image = site_url($game_image);
		}
		$imageSize = getimagesize($game_image);  		
	?>
	</div>
	<span style="padding: 10px;"><a href="#" onclick="javascript:viewImage(<?php echo $imageSize[0]+50; ?>, <?php echo $imageSize[1]+50; ?>); return false;"><img src="<?php echo $game_thumbnail; ?>"></a></span>
