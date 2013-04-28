<?php foreach ($descripciones as $descripcion): ?>
<label>Descripcion <?php echo $descripcion ['lan_description']?></label>
<textarea name="description[<?php echo $descripcion['lan_id']; ?>]" cols="100" rows="10"><?php echo $descripcion['idl_description']; ?></textarea>
<?php endforeach; ?>