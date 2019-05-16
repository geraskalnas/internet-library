<?php
	echo $config;
	@$dat = json_decode(file_get_contents(realpath(dirname(__FILE__))."/../db/".$config["db"]["configFile"]), true);
	@$db = new mysqli($dat["auth"]["server"], $dat["auth"]["username"], $dat["auth"]["password"], $dat["auth"]["db"]);
	if ($db->connect_errno > 0) {
	    array_push($errors, 'Unable to connect to database [' . $db->connect_error . ']');
	}
	@$db->set_charset("utf8");
	//return $db;
?>
