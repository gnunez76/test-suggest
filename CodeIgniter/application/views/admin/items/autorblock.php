	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1; foreach ($autores as $autor): ?>
	<?php if ($autor['active'] == 1):?>
	<td>
	<div class="boton"><?php echo $autor['designer_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('autor','<?php echo $autor["gamedesigner_id"]; ?>'); return false;"></a>
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
	<?php $i=1; foreach ($autores as $autor): ?>
	<?php if ($autor['active'] != 1):?>
	<td>
	<div class="boton">
	<?php echo $autor['designer_name']; ?><a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('autor','<?php echo $autor["gamedesigner_id"]; ?>'); return false;"></a>
	</div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>
