<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 <!-- Bootstrap 3.3.5 -->
 <!-- Latest compiled and minified JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php 

if($_SESSION['role'] === 'Administrator' || $_SESSION['role'] === 'Employee'){
		
} else {
	//williamson turn, turning is important
	echo "Authorization Denied";
	die();
}

?>



<div style="color: #000;">
<b>Administrator Panel:</b>
<br />
<!-- 
<a href="?view=users_admin" id="users_admin_link">Manage Users</a> | <a href="?view=reports_admin" id="reports_admin_link">Manage Reports</a>
-->

<button type="button" id="users_admin_link" class="btn btn-primary">Users</button>  
<button type="button" id="reports_admin_link" class="btn btn-primary">Reports</button>  
<button type="button" id="projects_admin_link" class="btn btn-primary">Projects</button>  

</div>

<div id="action_panel" name="action_panel">
	<?php 

	if(!empty($_REQUEST['view'])){
	
	
	     if($_REQUEST['view'] === 'detail'){
			 include_once("templates/detail.php");
		 }
	}

	?>
	
</div><!-- ends action_panel -->



<script>

$( document ).ready(function() {
	$( "#users_admin_link" ).click(function() {
	    $("#action_panel").fadeIn("slow").load( "templates/users.php" );
		return false;
	});
	
	$( "#reports_admin_link" ).click(function() {
	    $("#action_panel").fadeIn("slow").load( "templates/reports.php" );
		return false;
	});
	
	$( "#projects_admin_link" ).click(function() {
	    $("#action_panel").fadeIn("slow").load( "templates/projects_admin.php" );
		return false;
	});
	
	
	/*
	$( "#list" ).click(function() {
	  alert( "Handler for .click() called." );
	});
	*/
});



</script>