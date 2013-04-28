<?php foreach ($titulos as $titulo): ?>
<label>Titulo <?php echo $titulo ['lan_description']?></label>
<input type="text" name="newTitleLan[<?php echo $titulo['lan_id']; ?>]" value="<?php echo $titulo['itl_title']; ?>" style="width: 400px;">
<?php endforeach; ?>