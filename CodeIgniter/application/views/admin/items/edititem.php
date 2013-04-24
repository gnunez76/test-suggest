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

.bloquecheckbox span, .bloquecheckboxdesactivados span {

	margin-left: 10px;
}

.bloquecheckbox td, .bloquecheckboxdesactivados td {

	width: 300px;
}

.boton, .boton_plus {

	padding: 5px;
	border: 1px solid #555555;
	background-color: #F8F8F8 ;
	text-decoration: none;
}

.boton:hover {
	background-color: #CCCCCC;
	
}

.boton_plus {
	width: 100px;
}

.boton_plus:hover {
	background-color: #CCCCCC;	
}

.boton_plus a {
	float: right;
}


.bloquecheckbox .boton {

	background-color: #BCF5A9;
}

.bloquecheckbox .boton:hover {

	background-color: #CCCCCC;
}

.bloquecheckboxdesactivados .boton:hover {

	background-color: #BCF5A9;
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

function desactivarElemento (tipo, id) {

	switch(tipo)
	{
		case 'autor':

			$.get('/si_admin/deactivateautor/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockAutor/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueAutor').html(data);
			});
			break;

		case 'itemname':
			$.get('/si_admin/deactivateItemName/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockItemName/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueItemName').html(data);
			});
			break;
		case 'ilustrador':
			$.get('/si_admin/deactivateIlustrador/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockIlustrador/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueIlustrador').html(data);
			});
			break;
		case 'editorial':
			$.get('/si_admin/deactivateEditorial/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockEditorial/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueEditorial').html(data);
			});
			break;

		case 'mecanicas':
			$.get('/si_admin/deactivateMecanica/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockMecanicas/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueMecanicas').html(data);
			});
			break;

		case 'categorias':
			$.get('/si_admin/deactivateCategoria/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockCategorias/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueCategorias').html(data);
			});
			break;
			
	}

	
}

function activarElemento (tipo, id) {

	switch(tipo)
	{
		case 'autor':

			$.get('/si_admin/activateautor/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockAutor/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueAutor').html(data);
			});
			break;

		case 'itemname':
			$.get('/si_admin/activateItemName/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockItemName/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueItemName').html(data);
			});
			break;
			
		case 'ilustrador':
			$.get('/si_admin/activateIlustrador/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockIlustrador/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueIlustrador').html(data);
			});
			break;
			
		case 'editorial':
			$.get('/si_admin/activateEditorial/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockEditorial/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueEditorial').html(data);
			});
			break;

		case 'mecanicas':
			$.get('/si_admin/activateMecanica/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockMecanicas/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueMecanicas').html(data);
			});
			break;
			
		case 'categorias':
			$.get('/si_admin/activateCategoria/'+id+'/'+<?php echo $game_id; ?>);
			$.get('/si_admin/getBlockCategorias/'+<?php echo $game_id; ?>, function(data) {
				$('#bloqueCategorias').html(data);
			});
			break;
			
	}

	
}


</script>


<form id="form" name="form" method="post" action="/si_admin/updateItem/">



<label>Nombre</label>
<div id="addName">
	<input type="text" name="newName" value="">
	<a class="boton" href="#">A&Ntilde;ADIR NOMBRE</a>
</div>
<div id="bloqueItemName">
	<div class="bloquecheckbox">
	<table>
	<tr>
	<?php $i=1; foreach ($itemnames as $name): ?>
	<?php if ($name['active'] == 1):?>
	<td> 
	<div class="boton"><?php echo $name['game_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-minus imgright" onclick="javascript: desactivarElemento('itemname','<?php echo $name["gamename_id"]; ?>'); return false;"></a></div>
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
	<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('itemname','<?php echo $name["gamename_id"]; ?>'); return false;"></a></div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>
</div>

<label>Dise&ntilde;adores</label>
<div id="bloqueAutor">
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
	<div class="boton"><?php echo $autor['designer_name']; ?>
	<a href="#" class="ui-icon ui-icon-circle-plus imgright" onclick="javascript: activarElemento('autor','<?php echo $autor["gamedesigner_id"]; ?>'); return false;"></a>
	</div>
	</td>
	<?php if ($i%3 == 0) { echo "</tr><tr>"; } $i++; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</tr>
	</table>
	</div>
</div>

<label>Ilustradores</label>
<div id="bloqueIlustrador">
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
</div>

<label>Editoriales</label>
<div id="bloqueEditorial">
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
</div>

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
<div id="bloqueMecanicas">
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
</div>

<label>Categorias</label>
<div id="bloqueCategorias">
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
</div>


<br>
<input type="submit" name="enviar" value="Actualizar">


</form>
