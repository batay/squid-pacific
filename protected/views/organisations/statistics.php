<?php
/* @var $this OrganisationsController */
 ?>
<p>merhaba dünya</p>

<script>
		jQuery(document).ready(function() {
		console.log("<?php echo $organisationId; ?>");	
		    $('#li_<?php echo $organisationId; ?>').addClass('current');	
			App.setPage("gallery");  //Set current page
			App.init(); //Initialise plugins and elements
		});
</script>