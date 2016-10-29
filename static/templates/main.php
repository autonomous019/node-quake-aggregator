<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-control" content="no-cache">
<title>FSI | Old School Integrity – New School Excellence</title>
<link href="favicon.ico" type="image/x-icon" rel="icon"/><link href="favicon.ico" type="image/x-icon" rel="shortcut icon"/>
 <!-- jQuery 2.1.4 -->
 <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/fsi.css"/>
</head>
<body>
	<!-- need to re-write class name using JS with view change 
	
	home, projects, in_progress, commercial, education, remediation, multi_unit, residential
		
	-->
	<?php
	    if($view === 'main'){
	       $mode = "home";
	    } elseif ($view === 'projects'){
		   $mode = "projects"; 
		} elseif ($view === 'inspections'){
		   $mode = "inspections"; 
		} elseif ($view === 'opportunities'){
		   $mode = "opportunities"; 
		} elseif ($view === 'projects'){
		   $mode = "projects"; 
		} elseif ($view === 'service'){
		   $mode = "service"; 
		} elseif ($view === 'in_progress'){
		   $mode = "in_progress"; //use underscore in css less file
		} elseif ($view === 'commercial'){
		   $mode = "commercial"; 
		} elseif ($view === 'education'){
		   $mode = "education"; 
		} elseif ($view === 'remediation'){
		   $mode = "remediation"; 
		} elseif ($view === 'multi_unit'){
		   $mode = "multi_unit"; 
		} elseif ($view === 'residential'){
		   $mode = "residential"; 
		} elseif ($view === 'about'){
		   $mode = "about"; 
		} elseif ($view === 'contact'){
		   $mode = "contact"; 
		} elseif ($view === 'login'){
		   $mode = "login"; 
		} elseif ($view === 'logout'){
		   $mode = "logout"; 
		} elseif ($view === 'register'){
		   $mode = "register"; 
		}  elseif ($view === 'reset'){
		   $mode = "reset"; 
		} elseif ($view === 'confirm'){
		   $mode = "confirm"; 
		} elseif ($view === 'pages'){
		   $mode = "projects_pages"; 
		} else {
		    $mode = "home";
		}
	
	?>	
		
		
<div class="wrap <?= $mode; ?>">
<header>
<?php 
    include_once("nav.php");
?>
</header> 



<?php 
    require_once($mode.".php");
?>




</div>
<footer>
<div class="container">
<div class="row">
<div class="col-sm-6 copyright">
&copy; Copyright 2015 Fire Sprinklers, Inc.
</div>
<div class="col-sm-6 emergency">
24 Hour Emergency Service 253.826.0099
</div>
</div>
</div>
</footer>
 
 
 
 <!-- REQUIRED JS SCRIPTS -->

 <!-- jQuery 2.1.4 -->
 <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <!-- Bootstrap 3.3.5 -->
 <script src="bootstrap3/js/bootstrap.min.js"></script>

</body>
</html>
