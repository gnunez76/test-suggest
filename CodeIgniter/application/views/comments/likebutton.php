<script>
	$(document).ready(function() {
		
		var commentId =<?php echo "'".$commentId."'"; ?>;
		
		$("#btnlike_"+commentId).click (function (){
			$("#btnlike_"+commentId).html ("<img src='/assets/images/ajax-loader.gif' alt='cargando'>");
			$("#btnlike_"+commentId).load ('<?php echo site_url('comments/likeThisReview'); ?>/'+commentId, function (response, status) {


				
				if (status == "success") {
					$("#btnlike_"+commentId).html ("TE GUSTA");
					$("#btnlike_"+commentId).css("cursor", "	default");
				}
				else {
					alert ('Ya te gusta');
					$("#btnlike_"+commentId).html ("TE GUSTA");
				}
			});

		});
		

	});
</script>

<div class="botonmegusta" id="btnlike_<?php echo $commentId; ?>"><?php echo $literal; ?></div>
