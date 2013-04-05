<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $game_name;  ?></title>
		<link rel="stylesheet" href="/assets/css/item.css"/>
    </head>
    <body>
		<header>
		</header>
        <nav>
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

				<img src="<?php echo 'http://cf.geekdo-images.com/images/'.$game_thumbnail;    ?>" />
				
		        <p><?php echo $game_description; ?></p>

    	  </article>              

	 </section>
        <footer>
            <small>
                Copyright &copy; 2011<br/>
                Actualizado en: 11 Noviembre 2011           
            </small>        
        </footer>
    </body>
</html>
