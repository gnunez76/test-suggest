<link href="/assets/css/admin/style.css" rel="stylesheet">

<script src="/assets/js/jquery-1.9.1.min.js"></script>
<link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
<script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script>


<?php 
	$this->load->helper('url'); 
?>

<script type="text/javascript">
$(function() {

	$( "#autocompleteitem" ).autocomplete({
		source: "/si_admin/getitems/",
		search: function (event, ui) {
             	
			$("#autocompleteitem").val("Buscando... ");
		},
		response: function ( event, ui ) {
			for (j=0; j<ui.content.length; j++) {

				ui.content[j].value=ui.content[j].game_id;
				ui.content[j].label=ui.content[j].game_name;							
			}
			$("#autocompleteitem").val("");
		},
		select: function( event, ui ) { 

			document.location.href='/si_admin/editarItem/'+ui.item.value;
			$("#autocompleteitem").val('Redireccionando');
		},
		close: function( event, ui ) { 
			$("#autocompleteitem").val('');
                   
		}
	});

});
</script>

<div style="margin-top: 20px; margin-left: 30px;">
	<input type="search" placeholder="Busca un juego..." autocomplete="off" id="autocompleteitem" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
</div>


<table summary="items" id="hor-minimalist-b">
  <caption></caption>
  <thead>
  	<tr>
  		<th colspan="5"><?php echo $pagination; ?></th>
  	</tr>
    <tr>
    	<th scope="col">ID.</th>
		<th scope="col">Imagen</th>
		<th scope="col">Item</th>
		<th scope="col">A&ntilde;o</th>
		<th scope="col"></th>
    </tr>
  </thead>
 

  <tfoot>
    <tr>
		<th colspan="5"><?php echo $pagination; ?></th>
	</tr>
  </tfoot>
  
  <tbody>
  <?php foreach ($items as $item): ?>
  
  
    <tr>
	  <td><?php echo $item['game_id']; ?></td>
      <td><img src="<?php echo $item['game_thumbnail']; ?>" width="80"></td>
      <td><?php echo $item['game_name']; ?></td>
      <td><?php echo $item['game_yearpub']; ?></td>
      <td><?php echo anchor('/si_admin/editarItem/'.$item['game_id'], 'Editar', 'title="Editar"'); ?></td>
    </tr>
	<?php endforeach; ?>
  </tbody>
</table>