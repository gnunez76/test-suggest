	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1;foreach ($expansions as $expansion): ?>
	<?php if ($expansion['active'] == 1):?>
	<td>
	<div class="boton"><?php echo substr($expansion['game_name'], 0, 40)."..."; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright"  onclick="javascript: desactivarElemento('expansiones','<?php echo $expansion["game_id"]; ?>'); return false;"></a>
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
	<?php $i=1;foreach ($expansions as $expansion): ?>
	<?php if ($expansion['active'] != 1):?>
	<td>
	<div class="boton"><?php echo substr($expansion['game_name'], 0, 40)."..."; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright"  onclick="javascript: activarElemento('expansiones','<?php echo $expansion["game_id"]; ?>'); return false;"></a>
	</div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>