<div style="color: #000;">



<?php



if(isset($_REQUEST['id'])){
	$uid = $_REQUEST['id'];
	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$u = new Users('unknown', BASE_DOMAIN);
	if($u->confirm_email($uid)){
		echo "<br /><br /><b>Thanks your email is now confirmed. <a href=\"".SITE_DOMAIN.PATH_TO_SITE."?view=login\">Log-In</a></b>";
	}	else {
		echo "<br /><br />Sorry we were unable to confirm your email address.";
	}
	
	
}
	
//echo "path: ";
//echo SITE_DOMAIN.PATH_TO_SITE;	
	
?>


</div>