	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1; foreach ($artists as $artist): ?>
	<?php if ($artist['active'] == 1):?>
	<td>
	<div class="boton"><?php echo $artist['artist_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('ilustrador','<?php echo $artist["gameartist_id"]; ?>'); return false;"></a>
	</div>	
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>
	
	<div class="bloquecheckboxdesactivados">
	<table>
	<tr>
	<?php $i=1; foreach ($artists as $artist): ?>
	<?php if ($artist['active'] != 1):?>
	<td>
	<div class="boton"><?php echo $artist['artist_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('ilustrador','<?php echo $artist["gameartist_id"]; ?>'); return false;"></a>
	</div>	
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>