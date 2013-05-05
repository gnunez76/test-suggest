<!-- ELIMINAR CSS -->
<!--  
<link href="/assets/css/estilos.css" rel="stylesheet">

<link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">

<link href="/assets/css/rating-stars/jquery.rating.css" rel="stylesheet">
<link href="/assets/css/smoothness/jquery-ui-1.10.2.custom.min.css" rel="stylesheet">

-->
<!-- /ELIMNAR CSS -->
<!-- ELIMINAR JS -->
<!--      
<script src="/assets/js/jquery-1.9.1.min.js"></script>
<script src="/assets/js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="/assets/js/rating-stars/jquery.rating.pack.js"></script>
<script type="text/javascript" src="/assets/js/jquery.form.js"></script> 
<script>
function toogle (display, element) {
	
	document.getElementById(element).style.display=display;
}

</script>
-->
<!-- /ELIMINAR JS -->

<script type="text/javascript">
$(document).ready(function() {
	$('.star-review').rating({
		required: true,
		callback: function(value, link) {
		            	
			aValue = value.split('|');
			$.get('<?php echo site_url('juego/rateitem/'.$itemId); ?>/'+aValue[0]);
		
		}
	});
});
</script>

<script type="text/javascript">

function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
    	"ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	range.moveStart ('character', strPos);
    	range.moveEnd ('character', 0);
    	range.select();
    }
    else if (br == "ff") {
    	txtarea.selectionStart = strPos;
    	txtarea.selectionEnd = strPos;
    	txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

</script>


<script type="text/javascript">  

	// esperamos que el DOM cargue
	$(document).ready(function() { 
		// definimos las opciones del plugin AJAX FORM
		var opciones= {
			beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
			success: mostrarRespuesta //funcion que se ejecuta una vez enviado el formulario
		};
	
		//asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
	//	$('#reviewForm').ajaxForm() ; 
		$('#reviewForm').ajaxForm(opciones) ; 
	
		//lugar donde defino las funciones que utilizo dentro de "opciones"
		function mostrarLoader(){
			$("#modalReview").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
			//$("#comments").append ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>"); //muestro el loader de ajax
		};
	
	
		function mostrarRespuesta (responseText){
			
			if (responseText == 'OK') {
				$("#modalReview").html ('<h3 style="text-align:center;">Su rese&ntilde;a ha sido guardada</h3><input class="closebtn" name="close" type="button" value="Cerrar" onclick="modalReview(\'none\',\'modal\',\'ventana\'); return false;" >');

				$("#comunityReviews").html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
				$.get('<?php echo site_url('comments/getallreviews/'.$itemId); ?>', function(data) {
					$('#comunityReviews').html(data);
				});
				
			}
	//		alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
	//		$("#comments").html('Gracias por enviar tu review <br><div class="botonreview"><a href="#close" title="Close">CERRAR</a></div>'); // Hago desaparecer el loader de ajax
	//		$("#ajax_loader").append("<br>Mensaje: "+responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
		};
	
	}); 
 
</script>  
        
<script>


       $(function() {

                $( "#autocompletegame" ).autocomplete({
                        source: "<?php echo site_url('juego/buscador/'); ?>",
                        search: function (event, ui) {
                            
                            $("#autocompletegame").val("Buscando... ");
                        },
                        response: function ( event, ui ) {
							for (j=0; j<ui.content.length; j++) {

							var resultAux = ui.content[j].value.split('|');
							ui.content[j].value=resultAux[0];
							ui.content[j].label=resultAux[1];
						
							}
                            $("#autocompletegame").val("");
                        },
						select: function( event, ui ) { 
							
							//var itemAux = ui.item.value.split('/');
							//$('#userreviewtext').val($('#userreviewtext').val()+'<a href="'+ui.item.value+'">'+ui.item.label+'</a>');
							insertAtCaret('userreviewtext','<a href="'+ui.item.value+'">'+ui.item.label+'</a>');
							/*
							$("#juegosrelacionados").append('<input type="hidden" name="juegos['+itemAux[5]+']" id="juegos_'+itemAux[5]+'" value="'+itemAux[5]+'">')
							$("#juegosrelacionados").append('<div style="margin:5px;" id="label_juegos_'+itemAux[5]+'">'+ui.item.label+'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(&#039'+'juegos_'+itemAux[5]+'&#039, &#039'+'label_juegos_'+itemAux[5]+'&#039); return false;">Borrar</a></div>');
							*/
							$("#autocompletegame").val('');
						},
	                    close: function( event, ui ) { 
	                        $("#autocompletegame").val('');
	                          
	                    }
                });

        });


       $(function() {

           $( "#autocompleteautor" ).autocomplete({
                   	source: "<?php echo site_url('juego/autor/'); ?>",
                    search: function (event, ui) {
                    	
                           $("#autocompleteautor").val("Buscando... ");
                    },
                   	response: function ( event, ui ) {
						for (j=0; j<ui.content.length; j++) {
			
							var resultAux = ui.content[j].value.split('|');
							ui.content[j].value=resultAux[0];
							ui.content[j].label=resultAux[1];
								
						}
						$("#autocompleteautor").val("");
                   	},
					select: function( event, ui ) { 


						var itemAux = ui.item.value.split('/');

						//$('#userreviewtext').val($('#userreviewtext').val()+'<a href="'+ui.item.value+'">'+ui.item.label+'</a>');
						insertAtCaret('userreviewtext','<a href="'+ui.item.value+'">'+ui.item.label+'</a>');
						
						/*
						$("#autoresrelacionados").append('<input type="hidden" name="autores['+itemAux[5]+']" id="autores_'+itemAux[5]+'" value="'+itemAux[5]+'">')
						$("#autoresrelacionados").append('<div style="margin:5px;" id="label_autores_'+itemAux[5]+'">'+ui.item.label+'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(&#039'+'autores_'+itemAux[5]+'&#039, &#039'+'label_autores_'+itemAux[5]+'&#039); return false;">Borrar</a></div>');
						*/
						$("#autocompleteautor").val('');
						//document.location.href=ui.item.value; 
              			//$("#autocompleteautor").value('');
              			//$("#autocompleteautor").close();
              			//return false;
					},
                    close: function( event, ui ) { 
                        $("#autocompleteautor").val('');
                          
                    }
           });

   });
       
</script>        
		





<?php if ($isLogin): ?>






<div id="comments">



<div class="userrated-form">

	<span class="label10">Tu puntuaci&oacute;n</span>
	<div class="starblock clearfix">
		<?php  
		
			for ($i = 1; $i <= SI_ITEM_RATING_AVAILABE; $i++) {
	
				if ($i == $rateGame) {
					echo '<input name="rating-review" type="radio" class="star-review" value="'.$i.'" checked="checked" />';
				}
				else {
					echo '<input name="rating-review" type="radio" class="star-review" value="'.$i.'" />';
				}
			}
			
		?>
	</div>
	
</div>


<form method="post" action="<?php echo site_url('comments/insertitemcomment/'.$itemId); ?>" id="reviewForm">


        
<label>T&iacute;tulo*</label>
<?php if ($reviewItem['comment_title']): ?>
<input class="reviewtitle" name="titulo" placeholder="T&iacute;tulo de tu rese&nacute;a..." required="true" value="<?php echo $reviewItem['comment_title']; ?>"/>
<?php else: ?>
<input class="reviewtitle" name="titulo" placeholder="T&iacute;tulo de tu rese&ntilde;a..." required="true" />
<?php endif; ?>
            
<label>Texto*

<span style="margin-left: 400px;">
<input class="closebtn" name="close" type="button" value="Citar juego o autor" onclick="javascript:toogle('block', 'relautite');; return false;" >

</span></label>
<textarea name="texto" id="userreviewtext" placeholder="Danos tu opini&oacute;n..." required="true"><?php if($reviewItem['comment_text']) { echo $reviewItem['comment_text']; }  ?></textarea>


<label>Imagenes</label>
<div id="imgfail"></div>
<div id="imgsuccess" class="imgsuccess">

<?php if (isset($reviewImages) && is_array($reviewImages)): ?>
	<script>
		$(function () {
				$('#imgsuccess').css('display', 'block');
		});
	</script>
	<?php  foreach ($reviewImages as $images): ?>            
		<span style="padding: 10px;"><a href="#" onclick="javascript:insertAtCaret('userreviewtext','<img src=&quot<?php echo $images ['image_original']?>&quot>'); return false;"><img src="<?php echo $images['image_thumbnail']; ?>"></a></span>
	<?php endforeach; ?>
<?php endif; ?>

</div>
<div class="moduloimagesformreview">
	
<!-- ########################################## -->
<script>
var VIGET = VIGET || {};
VIGET.fileInputs = function() {
    var $this = $(this),
    $val = $this.val(),
    valArray = $val.split('\\'),
    newVal = valArray[valArray.length-1],
    $button = $this.siblings('.button'),
    $fakeFile = $this.siblings('.file-holder');
};
     
$(document).ready(function() {
    $('.file-wrapper input[type=file]')
    .bind('change focus click', VIGET.fileInputs);
});
</script>


<span class="file-wrapper">
<input id="fileupload" type="file" name="files[]" multiple>
<span class="button">A&ntilde;adir im&aacute;genes...</span>
</span>

	


<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js"></script>
<script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>
<script src="/assets/js/fileupload/jquery.fileupload.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        url: '<?php echo site_url('users_interface/uploadfilestoserver/'.$itemId); ?>',
        dataType: 'json',

        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //alert (file.error);
                //alert (file.name);
                
                if (file.error == undefined) {
                    var tagImg = '<img src=&quot'+file.url+'&quot>';
                    //alert (tagImg);
                    // onclick="insertAtCaret(\'userreviewtext\','+tagImg+'); return false;"
                    
                	$('#imgsuccess').append('<span style="padding: 10px;"><a href="#" onclick="javascript:insertAtCaret(\'userreviewtext\',\''+tagImg+'\'); return false;"><img src="'+file.thumbnail_url+'"></a></span>');
                	$('#imgsuccess').css('display', 'block');
                }
                else {
                	$('#imgfail').append(file.name+' - '+file.error+'<br>');
                }
                
            });
        },


        
	    progressall: function (e, data) {
	        var progress = parseInt(data.loaded / data.total * 100, 10);


	        $(function() {
	        	$( "#progressbar" ).progressbar({
	        	value: progress
	        	});
	        });
	        
	        /*
	        $('#progress .bar').css(
	            'width',
	            progress + '%'
	        );
	        */
	    }
        


    });
    
});
</script>






<!-- ########################################## -->


 
	

</div>
<div id="progressbar"></div>

<div class="relacionarcon" id="relautite" style="display:none">
	<label>Relacionar con juego</label>
	<input type="search" placeholder="Busca un juego..." autocomplete="off" id="autocompletegame" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
	<div class="elementosrelacionados" id="juegosrelacionados">
	<?php 
		if (isset($reviewItemItems) && is_array($reviewItemItems)) {
	
			foreach ($reviewItemItems as $itemrel) {
				echo '<input type="hidden" name="juegos['.$itemrel['game_id'].']" id="juegos_'.$itemrel['game_id'].'" value="'.$itemrel['game_id'].'">';
				echo '<div style="margin:5px;" id="label_juegos_'.$itemrel['game_id'].'">'.$itemrel['game_name'].
				'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(\'juegos_'.$itemrel['game_id'].'\', \'label_juegos_'.$itemrel['game_id'].'\'); return false;">Borrar</a></div>';
			}
	
		} 
		
	?>
	
	</div>
	
	<label>Relacionar con autor</label>
	<input type="search" placeholder="Busca un autor..." autocomplete="off" id="autocompleteautor" name="q" dir="ltr" spellcheck="false" style="width: 300px; display: block;">
	<div class="elementosrelacionados" id="autoresrelacionados">
	<?php 
		if (isset($reviewItemAutores) && is_array($reviewItemAutores)) {
	
			foreach ($reviewItemAutores as $autor) {
				echo '<input type="hidden" name="autores['.$autor['gamedesigner_id'].']" id="autores_'.$autor['gamedesigner_id'].'" value="'.$autor['gamedesigner_id'].'">';
				echo '<div style="margin:5px;" id="label_autores_'.$autor['gamedesigner_id'].'">'.$autor['designer_name'].
					'<a style="padding-left:5px;" href="#" onClick="javascript:borrar(\'autores_'.$autor['gamedesigner_id'].'\', \'label_autores_'.$autor['gamedesigner_id'].'\'); return false;">Borrar</a></div>';
			}
		} 
		
	?>
	</div>
	<input class="closebtn" name="close" type="button" value="Cerrar" onclick="toogle('none','relautite'); return false;" >
	<a href="#close" title="Cerrar" onclick="toogle('none','relautite'); return false;" >Close</a>
</div>

<label>Notas privadas (solo ser&aacute;n visibles por t&iacute;)</label>
<textarea name="notas_privadas" placeholder="Escribe unas notas solo par t&iacuta;..."><?php if($reviewItem['comment_text']) { echo $reviewItem['comment_notes']; }  ?></textarea>


<div>
<label class="sharetwitter">Compartir en twitter (Pruebas al final del desarrollo)</label>
<input name="sharetwitter" type="checkbox" class="sharetwittercb" />
</div>

<?php if (is_array($reviewItem)): ?>
<input id="submit" name="submit" type="submit" value="Actualizar">
<?php else: ?>           
<input id="submit" name="submit" type="submit" value="Publicar">
<?php endif; ?>
<input class="closebtn" name="close" type="button" value="Cancelar" onclick="modalReview('none','modal','ventana'); return false;" >
        
<div id="ajax_loader"></div>
</form>
</div>
<?php else: ?>

 <?php $this->load->helper('url'); ?>

<div>
<?php echo anchor('hauth/login/Google?backURL='.current_url(), '<img src="/assets/images/top-google.png" alt="Google">', array ('title' => 'Login con Google')); ?>
<?php echo anchor('hauth/login/Facebook?backURL='.current_url(), '<img src="/assets/images/top-facebook.png" alt="Facebook">', array ('title' => 'Login con Facebook')); ?>
<?php echo anchor('hauth/login/Twitter?backURL='.current_url(), '<img src="/assets/images/top-twitter.png" alt="Twitter">', array ('title' => 'Login con Twitter')); ?>
</div>
 


<?php endif; ?>
