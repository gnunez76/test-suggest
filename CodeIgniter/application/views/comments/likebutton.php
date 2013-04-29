<script>
	$(document).ready(function() {
		
		var commentId =<?php echo "'".$commentId."'"; ?>;
		
		$("#btnlike_"+commentId).click (function (){
			$("#btnlike_"+commentId).html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
			$("#btnlike_"+commentId).load ('<?php echo site_url('comments/likeThisReview/'.$commentId); ?>', function (response, status) {


				
				if (response == "OK") {
					$("#btnlike_"+commentId).html ("TE GUSTA");
					$("#btnlike_"+commentId).css("cursor", "default");
				}
				else if (response = "KO") {
					$("#btnlike_"+commentId).html ("TE GUSTA");
					alert ('Ya te gusta');
				}
				else {
					alert (response);
				}
			});

		});
		

	});
</script>

<div class="botonmegusta" id="btnlike_<?php echo $commentId; ?>"><?php echo $literal; ?></div>
