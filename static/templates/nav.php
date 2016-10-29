<div class="navbar navbar-inverse">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="" class="navbar-brand">FSI</a> </div>
<div class="collapse navbar-collapse" id="navbar-collapse-main">
<ul class="nav navbar-nav">
<li><a href="?view=inspections">Inspections</a></li>
<li><a href="?view=service">Service</a></li>
<li><a href="?view=main" class="fsi-logo">Home</a></li>
<li><a href="?view=projects">Projects</a></li>
<li><a href="?view=opportunities">Opportunities</a></li>
</ul>
</div>
</div>
</div>


<?php

require_once("config.inc.php");

if(!empty($_REQUEST['view'])){
	$my_nav_view = $_REQUEST['view'];
} else {
	$my_nav_view = "";
}



if(!empty($_SESSION['uid']) && $my_nav_view === 'main'){
	
		$user_nav = "set";
	
	
	
} elseif( empty($_SESSION['uid']) && $my_nav_view === 'main') {
	$user_nav = "set_unlogged";
	
	
} elseif(empty($_REQUEST['view'])){
    
     $user_nav = "set_unlogged";
	
} else {
	
	$user_nav = "unset"; 
	
}


?>




<?php
if($user_nav === 'set'){
	//limiting user nave to main view for now
	
	?>

	<div class="top-nav"><a href="?view=about">About Us</a> / <a href="?view=contact">Contact Us</a> / <a href="?view=admin" style="font-weight:bold;">My Account</a></div>
	<?php
	
} elseif ($user_nav === "set_unlogged") {
	?>
	
	<div class="top-nav"><a href="?view=about">About Us</a> / <a href="?view=contact">Contact Us</a> / <a href="?view=login" style="font-weight:bold;">Login</a></div>
	
<?php 
} else {
	//show nothing on a sub page. 
}

?>


 