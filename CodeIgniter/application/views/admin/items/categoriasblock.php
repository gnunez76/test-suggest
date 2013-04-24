	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1;foreach ($categories as $category): ?>
	<?php if ($category['active'] == 1):?>
	<td>
	<div class="boton"><?php echo $category['category_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright"  onclick="javascript: desactivarElemento('categorias','<?php echo $category["gamecategory_id"]; ?>'); return false;"></a>
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
	<?php $i=1;foreach ($categories as $category): ?>
	<?php if ($category['active'] != 1):?>
	<td>
	<div class="boton"><?php echo $category['category_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright"  onclick="javascript: activarElemento('categorias','<?php echo $category["gamecategory_id"]; ?>'); return false;"></a>
	</div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>