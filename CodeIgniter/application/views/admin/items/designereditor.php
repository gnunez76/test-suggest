<?php 
foreach($css_files as $file): ?>    
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" /> 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>

<link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
<script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script>

<script>

$(function() {

	$( "#autocompletedesigner" ).autocomplete({
		source: "/si_admin/getautores/",
		search: function (event, ui) {
             	
			$("#autocompletedesigner").val("Buscando... ");
		},
		response: function ( event, ui ) {
			for (j=0; j<ui.content.length; j++) {

				ui.content[j].value=ui.content[j].gamedesigner_id;
				ui.content[j].label=ui.content[j].designer_name;							
			}
			$("#autocompletedesigner").val("");
		},
		select: function( event, ui ) { 

			document.location.href='/si_admin/gridDesigners/edit/'+ui.item.value;
			$("#autocompletedesigner").val('');
		},
		close: function( event, ui ) { 
			$("#autocompletedesigner").val('');
                   
		}
	});

});

</script>

<div style="margin-top: 20px; margin-left: 30px;">
	<input type="search" placeholder="Busca un dise&ntilde;ador..." autocomplete="off" id="autocompletedesigner" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
</div>
<div style='height:20px;'></div>
<div>
<?php echo $output; ?>
</div>