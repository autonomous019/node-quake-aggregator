<div style="color: #000;">


<?php 

if($_SESSION['role'] === 'Administrator' || $_SESSION['role'] === 'Employee'){
		
} else {
	//williamson turn, turning is important
	echo "Authorization Denied";
	die();
}

?>



<div style="color: #000;">
<b>Employee Panel:</b>
<br />
<a href="?view=reports_admin" id="reports_admin_link">Manage Reports</a>


</div>

<div id="action_panel" name="action_panel">
	
	
</div><!-- ends action_panel -->

<script>

$( document ).ready(function() {

	$( "#reports_admin_link" ).click(function() {
	    $("#action_panel").load( "templates/reports.php" );
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