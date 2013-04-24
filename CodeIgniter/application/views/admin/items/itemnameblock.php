<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1; foreach ($itemnames as $name): ?>
<?php if ($name['active'] == 1):?>
<td> 
<div class="boton"><?php echo $name['game_name']; ?>
<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('itemname','<?php echo $name["gamename_id"]; ?>'); return false;"></a>
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
<?php $i=1; foreach ($itemnames as $name): ?>
<?php if ($name['active'] != 1):?>
<td> 
<div class="boton"><?php echo $name['game_name']; ?>
<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('itemname','<?php echo $name["gamename_id"]; ?>'); return false;"></a>
</div>
</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endif; ?>
<?php endforeach; ?>
</tr>
</table>
</div>
