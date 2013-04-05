<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $game_name;  ?></title>
	<link rel="stylesheet" href="/assets/css/item.css"/>

        <link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
        <script src="/assets/js/jquery-1.9.0.js"></script>
        <script src="/assets/js/jquery-ui-1.10.0.custom.js"></script>

        <script>


        $(function() {

                $( "#autocomplete" ).autocomplete({
                        source: "/juego/buscador/",
//                        search: function (event, ui) {
//                                $("#autocomplete").html("cargando... ");
//                        },
                        response: function ( event, ui ) {
				for (j=0; j<ui.content.length; j++) {

					$resultAux = ui.content[j].value.split('|');
					ui.content[j].value=$resultAux[0];
					ui.content[j].label=$resultAux[1];
						
				}
                                $("#autocomplete").html("");
                        },
			select: function( event, ui ) { 
				document.location.href=ui.item.value; 
                                $("#autocomplete").value('');
			}
                        //close: function( event, ui ) { searchSelection();  }
                });

        });
        </script>


    </head>
    <body>
		<header>
<h3>Buscador y Ficha PROTO</h3>
		</header>
        <nav>


	<div>
<input id="autocomplete" title="type" style="border: 1px dashed #CBC8BE; border-radius: 4px 4px 4px 4px; color: #4A3D2E; font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif; font-size: 1.1em; padding: 8px; width: 240px;"/>
	</div>
<!--
            <ul>
                <li><a href="#">inicio</a></li>
                <li><a href="#">blog</a></li>
                <li><a href="#">vídeos</a></li>
            </ul>
-->
        </nav>
	<section>

    	 <article>

        	 <header><h3><?php echo $game_name; ?></h3></header>

			<div style="float:left;">
			<img src="<?php echo 'http://cf.geekdo-images.com/images/'.$game_thumbnail;    ?>" />
			</div>
			<div style="float:left; padding-left: 25px;">
				<p><div style="float:left;"><strong>Autor: </strong></div><div style="float:left; padding-left: 5px;"><?php echo implode ('<br/>', $autor); ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Diseñador: </strong></div><div style="float:left; padding-top: 5px; padding-left: 5px;"><?php echo implode ('<br/>', $artist); ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Ano publicacion: </strong> <?php echo $game_yearpub; ?></div></p>
				<p><div style="clear:left; padding-top: 5px; float:left;"><strong>Editorial: </strong></div><div style="float:left; padding-top: 5px; padding-left: 5px;"><?php echo implode ('<br/>', $editorial); ?></div></p>
			</div>	
			
		        <div style="clear:left; padding-top: 10px;"><p><?php echo $game_description; ?></p>
			</div>

    	  </article>              

	 </section>
        <footer>
            <small>
            </small>        
        </footer>
    </body>
</html>
