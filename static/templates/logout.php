<div style="color: #000;">


<h3 style="color: #000;"> You are now logged out</h3>
<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!

if(!empty($_SESSION['uid'])){
	
	
} else {
	
	session_start();
}

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
/*if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
*/

// Finally, destroy the session.
session_destroy();

?>
<br /><br />
<a href="?view=login"><h3 style="color: #000;">Log In</h3></a>


</div>