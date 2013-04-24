	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1; foreach ($editoriales as $editorial): ?>
	<?php if ($editorial['active'] == 1):?>
	<td>
	<div class="boton"><?php echo $editorial['editorial_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('editorial','<?php echo $editorial["gameeditorial_id"]; ?>'); return false;"></a>
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
	<?php $i=1; foreach ($editoriales as $editorial): ?>
	<?php if ($editorial['active'] != 1):?>
	<td>
	<div class="boton"><?php echo $editorial['editorial_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('editorial','<?php echo $editorial["gameeditorial_id"]; ?>'); return false;"></a>
	</div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>	
	</div>