<script src="/assets/js/jquery-1.9.1.min.js"></script>
		
<style>
body {
	line-height: 1.6em;
	font-family: "Lucida Sans Unicode","Lucida Grande",Sans-Serif;
    font-size: 10px;

}

label {

	display: block;
	font-size: 14px;
}

input {

	margin: 10px;
}

textarea {
	margin: 10px;
}

select, option {
	margin: 10px;
}

.bloquecheckbox, .bloquecheckboxdesactivados {

	margin: 10px;
	width: 900px;
	min-height: 50px;
	border: 1px solid #669;
}

.bloquecheckboxdesactivados {

	background-color: #AAAAAA;
}

.bloquecheckbox span {

	margin-left: 10px;
}

.bloquecheckbox td {

	width: 300px;
}

.boton {

	padding: 5px;
	border: 1px solid #555555;
	background-color: #F8F8F8 ;
}

.imgright {
	float: right;
}

</style>

<link href="/assets/css/smoothness/jquery-ui-1.10.2.custom.min.css" rel="stylesheet">


<script>

function moverElemento (elementoId, destino, texto) {

//	alert (elementoId);
//	alert (destino);
	$("#"+elementoId).remove();
	$("#"+destino).append('<div class="boton" id="autordes_"'+elementoId+'>'+texto+
	'<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: moverElemento(\'kk\', \'autoresdes\'); return false;"></a></div>');
	
}

</script>


<form id="form" name="form" method="post" action="">



<label>Nombre</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1; foreach ($itemnames as $name): ?>
<td id="autor_<?php echo $name['gamename_id']?>">
<!-- 
<input name="itemnames[]" type="checkbox" value="<?php echo $name['gamename_id']; ?>" checked><?php echo $name['game_name']; ?>
 -->
 
<div class="boton" ><?php echo $name['game_name']; ?>
<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: moverElemento('<?php echo "autor_".$name["gamename_id"]; ?>', 'autoresdes', '<?php echo $name["game_name"]; ?>'); return false;"></a></div>
</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>

<div class="bloquecheckboxdesactivados" id="autoresdes"></div>

<label>Dise&ntilde;adores</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1; foreach ($autores as $autor): ?>
<td>
<!-- 
<input name="designers[]" type="checkbox" value="<?php echo $autor['gamedesigner_id']; ?>" checked><?php echo $autor['designer_name']; ?>
 -->
<div class="boton"><?php echo $autor['designer_name']; ?><a href="#" class="ui-icon ui-icon-circle-minus imgright"></a></div>

</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>

<div class="bloquecheckboxdesactivados"></div>

<label>Ilustradores</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1; foreach ($artists as $artist): ?>
<td>
<!-- 
<input name="artists[]" type="checkbox" value="<?php echo $artist['gameartist_id']; ?>" checked><?php echo $artist['artist_name']; ?>
 -->
<div class="boton"><?php echo $artist['artist_name']; ?><a href="#" class="ui-icon ui-icon-circle-minus imgright"></a></div>

</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>

<div class="bloquecheckboxdesactivados"></div>

<label>Editoriales</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1; foreach ($editoriales as $editorial): ?>
<td>
<!-- 
<input name="editorial[]" type="checkbox" value="<?php echo $editorial['gameeditorial_id']; ?>" checked><?php echo $editorial['editorial_name']; ?>
-->
<div class="boton"><?php echo $editorial['editorial_name']; ?><a href="#" class="ui-icon ui-icon-circle-minus imgright"></a></div>
</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>

<div class="bloquecheckboxdesactivados"></div>

<label>Dependencia del idioma</label>
<select name="deplenguaje">
  <?php foreach ($allLanDep as $lan): ?>
	<?php if ($languages[0]['gamelanguagedep_id'] == $lan['gamelanguagedep_id']): ?>
		<option value="<?php echo $lan['gamelanguagedep_id']; ?>" selected><?php echo $lan['language_name']; ?></option>
	<?php else: ?>
  		<option value="<?php echo $lan['gamelanguagedep_id']; ?>"><?php echo $lan['language_name']; ?></option>
  	<?php endif; ?>
  <?php endforeach; ?>
 
 
</select> 


<label>A&ntilde;o publicaci&oacute;n</label>
<input name="yearpub" type="text" value="<?php echo $game_yearpub; ?>">

<label>Minimo jugadores</label>
<input name="minplayer" type="text" value="<?php echo $game_minplayers; ?>">

<label>Maximo jugadores</label>
<input name="maxplayer" type="text" value="<?php echo $game_maxplayers; ?>">

<label>Edad recomendada</label>
<input name="age" type="text" value="<?php echo $game_age; ?>">

<label>Duracion</label>
<input name="duration" type="text" value="<?php echo $game_duration; ?>">

  
<label>Descripcion BGG</label>
<textarea name="bgg_description" cols="100" rows="10"><?php echo $game_description; ?></textarea>
<input type="hidden" name="itemId" value="<?php echo $game_id; ?>">

<label>Mecanicas</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1;foreach ($mechanics as $mechanic): ?>
<td>
<!-- 
<input name="mecanicas[]" type="checkbox" value="<?php echo $mechanic['gamemechanic_id']; ?>" checked><?php echo $mechanic['mechanic_name']; ?>
-->
<div class="boton"><?php echo $mechanic ['mechanic_name']; ?><a href="#" class="ui-icon ui-icon-circle-minus imgright"></a></div>

</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>
<div class="bloquecheckboxdesactivados"></div>

<label>Categorias</label>
<div class="bloquecheckbox">
<table>
<tr>
<?php $i=1;foreach ($categories as $category): ?>
<td>
<!-- 
<input name="categorias[]" type="checkbox" value="<?php echo $category['gamecategory_id']; ?>" checked><?php echo $category['category_name']; ?>
-->

<div class="boton"><?php echo $category['category_name']; ?><a href="#" class="ui-icon ui-icon-circle-minus imgright"></a></div>
</td>
<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
<?php endforeach; ?>
</tr>
</table>
</div>

<div class="bloquecheckboxdesactivados"></div>

<br>
<input type="submit" name="enviar" value="Actualizar">


</form>
