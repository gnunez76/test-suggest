	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1;foreach ($mechanics as $mechanic): ?>
	<?php if ($mechanic['active'] == 1):?>
	<td>
	<div class="boton"><?php echo $mechanic ['mechanic_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('mecanicas','<?php echo $mechanic["gamemechanic_id"]; ?>'); return false;"></a>
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
	<?php $i=1;foreach ($mechanics as $mechanic): ?>
	<?php if ($mechanic['active'] != 1):?>
	<td>
	<div class="boton"><?php echo $mechanic ['mechanic_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('mecanicas','<?php echo $mechanic["gamemechanic_id"]; ?>'); return false;"></a>
	</div>	
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>
	</div>