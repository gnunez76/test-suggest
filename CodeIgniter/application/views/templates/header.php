<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>TITULO</title>
	<link rel="stylesheet" href="/assets/css/item.css"/>

        <link href="/assets/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
        <script src="/assets/js/jquery-1.9.0.js"></script>
        <script src="/assets/js/jquery-ui-1.10.0.custom.js"></script>
	
        <link href="/assets/css/rating-stars/jquery.rating.css" rel="stylesheet">
        <script src="/assets/js/rating-stars/jquery.rating.pack.js"></script>

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

		<script>
			function getCookie(nombre)
			{	
 				if (document.cookie.length>0)
 				{
  					c_start=document.cookie.indexOf(nombre + "=");
  					if (c_start!=-1)
  					{
   						c_start=c_start + nombre.length+1;
   						c_end=document.cookie.indexOf(";",c_start);
   						if (c_end==-1)
    						c_end=document.cookie.length;
   						return unescape(document.cookie.substring(c_start,c_end));
  					}
 				}
 				return "";
			}

			
		</script>

	<style type="text/css">
		::selection {
			background-color:#E13300;
			color:#fff;
		}

		::moz-selection {
			background-color:#E13300;
			color:#fff;
		}

		::webkit-selection {
			background-color:#E13300;
			color:#fff;
		}

		body {
			background-color:#fff;
			margin:40px;
			font:13px/20px normal Helvetica,Arial,sans-serif;
			color:#4F5155;
		}

		a {
			color:#039;
			background-color:transparent;
			font-weight:400;
		}

		h1 {
			color:#444;
			background-color:transparent;
			border-bottom:1px solid #D0D0D0;
			font-size:19px;
			font-weight:400;
			margin:0 0 14px;
			padding:14px 15px 10px;
		}

		code,pre,fieldset {
			font-family:Consolas,Monaco,Courier New,Courier,monospace;
			font-size:12px;
			border:1px solid #D0D0D0;
			color:#002166;
			display:block;
			margin:10px 0 14px;
			padding:12px 10px;
		}

		fieldset {
			margin:10px 14px;
			overflow:auto;
		}

		#body {
			margin:0 15px;
		}

		p.footer {
			border-top:1px solid #D0D0D0;
			padding:10px 10px 0;
			margin:20px 0 0;
		}

		#container {
			margin:10px;
			border:1px solid #D0D0D0;
			-webkit-box-shadow:0 0 8px #D0D0D0;
		}

		.key {
			border:1px solid #000;
			border-right:none;
			border-bottom:0;
		}

		.value {
			border:1px solid #000;
			border-left:none;
			border-bottom:0;
		}

		#provider-list {
			list-style:none;
			margin:0;
			padding:0;
		}

		#provider-list a {
			position:relative;
			width:auto;
			float:left;
			margin:0 10px;
			padding:5px 10px;
			border:1px solid #eee;
			background:#f8f8f8;
		}

		#provider-list a.connected {
			padding-left:35px;
		}

		#provider-list a.connected:before {
		/*fill it with a blank space*/
			content:"\00a0";
		/*make it a block element*/
			display:block;
		/*adding an 8px round border to a 0x0 element creates an 8px circle*/
			border:solid 9px green;
			border-radius:9px;
			-moz-border-radius:9px;
			-webkit-border-radius:9px;
			height:0;
			width:0;
		/*Now position it on the left of the list item, and center it vertically
				(so that it will work with multiple line list-items)*/
			position:absolute;
			left:7px;
			top:47%;
			margin-top:-8px;
		}

		#provider-list a.connected:hover:before {
			border-color:#000;
		}

		#provider-list a.connected:after {
		/*Add another block-level blank space*/
			content:"\00a0";
			display:block;
		/*Make it a small rectangle so the border will create an L-shape*/
			width:3px;
			height:6px;
		/*Add a white border on the bottom and left, creating that 'L' */
			border:solid #fff;
			border-width:0 2px 2px 0;
		/*Position it on top of the circle*/
			position:absolute;
			left:14px;
			top:47%;
			margin-top:-4px;
		/*Rotate the L 45 degrees to turn it into a checkmark*/
			-webkit-transform:rotate(45deg);
			-moz-transform:rotate(45deg);
			-o-transform:rotate(45deg);
		}

		#provider-list a.connected:hover:after {
			content:"\D7";
			display:block;
			text-align:center;
			width:18px;
			position:absolute;
			left:7px;
			top:40%;
			margin-top:-8px;
			font-size:16px;
			line-height:18px;
			font-family:"Helvetica Neue",Consolas,Verdana,Tahoma,Calibri,Helvetica,Menlo,"Droid Sans",sans-serif;
			border:0;
			-webkit-transform:rotate(0deg);
			-moz-transform:rotate(0deg);
			-o-transform:rotate(0deg);
			color:#f8f8f8;
			box-shadow:none;
		}

		#provider-list li {
		}

		#provider-list a:hover,#provider-list .login:hover a:link,#provider-list .login:hover a:visited {
			background:#C64350;
			color:#F6CF74;
			text-shadow:1px 1px 1px #fff;
		}

		#provider-list a {
			text-decoration:none;
			display:block;
		}

		.pItem {
			list-style:none;
			font-size:1.15em;
			line-height:1.18em;
			padding:5px;
			margin:3px 0;
			color:#444;
			border:1px solid #e8e8e8;
			background-color:#f9f9f9;
			white-space:pre;
		/* CSS 2.0 */
			white-space:pre-wrap;
		/* CSS 2.1 */
			white-space:pre-line;
		/* CSS 3.0 */
			white-space:-pre-wrap;
		/* Opera 4-6 */
			white-space:-o-pre-wrap;
		/* Opera 7 */
			white-space:-moz-pre-wrap;
		/* Mozilla */
			white-space:-hp-pre-wrap;
		/* HP Printers */
			word-wrap:break-word;
		/* IE 5+ */
		}

		.pItem:hover {
			background:#ffc;
		}
	</style>

    </head>
    <body>
    

        <div id="body">
	
	<div id="conexion">

		<?php

			$this->load->helper('url');
			$this->load->helper('cookie');
		?>

<script>

var ckArr = document.cookie.split("; "); 
var userInfo = null; 
for (var nBucle=0; nBucle<ckArr.length; nBucle++) 
{
	var aCookie = ckArr[nBucle].split("="); 
	// Comprobamos que la cookie que necesitamos est? creada 
	if (aCookie[0] == "SI_UserName") 
	{
		var parametrosCookie = unescape(aCookie[1]); 
		userInfo = parametrosCookie.split("|")[0].replace('+',' ');
	}
}

var cadRegistro = '';
if (userInfo == null) 
{
  cadRegistro += 'Puedes logarte con: <span style="padding: 5px;">';
  cadRegistro += <?php echo "'".anchor('hauth/login/Google?backURL='.current_url(), 'Google', array ('title' => 'Login con Google'))."'"; ?>;
  cadRegistro += '</span>';
  cadRegistro += '<span style="padding: 5px;">';
  cadRegistro += <?php echo "'".anchor('hauth/login/Facebook?backURL='.current_url(), 'Facebook', array ('title' => 'Login con Facebook'))."'"; ?>;
  cadRegistro += '</span>';
  cadRegistro += '<span style="padding: 5px;">';
  cadRegistro += <?php echo "'".anchor('hauth/login/Twitter?backURL='.current_url(), 'Twitter', array ('title' => 'Login con Twitter'))."'"; ?>;
  cadRegistro += '</span>';
} 
else 
{
  cadRegistro += '<a href="" id="" title="">';
  cadRegistro += '<span>Hola '+userInfo+'</span>&nbsp;</a>';
  cadRegistro += '<span>';
  cadRegistro += <?php echo "'".anchor('hauth/logout/'.get_cookie('SI_Provider').'?backURL='.current_url(), 'Desconectar', array ('title', 'Desconectar'))."'";  ?>;
  cadRegistro += '</span>';
} 
document.write(cadRegistro);
</script>



        </div>

