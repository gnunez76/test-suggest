<link href="/assets/css/admin/style.css" rel="stylesheet">

<?php 
	$this->load->helper('url'); 
?>

<table summary="items" id="hor-minimalist-b">
  <caption>Items</caption>
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