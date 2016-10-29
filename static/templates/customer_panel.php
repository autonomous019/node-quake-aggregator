<div style="color: #000;">
<b>Customer Panel:</b>
<br />
 <a href="?view=reports_admin" id="reports_admin_link">My Reports</a>


</div>

<div id="action_panel" name="action_panel">
	
	
</div><!-- ends action_panel -->


<?php
	


$my_id = $_SESSION['uid'];
	
	
?>


<script>

$( document ).ready(function() {

	
	$( "#reports_admin_link" ).click(function() {
	    $("#action_panel").fadeIn("slow").load( "templates/customer_reports.php?id=<?= $my_id; ?>" );
		return false;
	});
	
	/*
	$( "#list" ).click(function() {
	  alert( "Handler for .click() called." );
	});
	*/
});



</script>
</div>

