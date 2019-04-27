<?php
	require("classes.php");
	
	$lbook = new l_book();
	$lbook->set_db($db);
	$luser = new l_user();
	$luser->set_db($db);
	$id=$luser->getIdByLoggedIP(@getIP());
	$username="guest";
	if($id!=0){
	    $luser->loadById($id);
	    $name=$luser->get_name();
	}
	defined("USERNAME")
		or define("USERNAME", $username);
	unset($id, $username);
?>