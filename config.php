<?php
switch ($_SERVER["SCRIPT_NAME"]) {
	case "/library/admin.php":
		$CURRENT_PAGE = "admin"; 
		$PAGE_TITLE = "Library System - admin";
		break;
	case "/library/login.php":
		$CURRENT_PAGE = "login"; 
		$PAGE_TITLE = "Library System - login";
		break;
	default:
		$CURRENT_PAGE = "Index";
		$PAGE_TITLE = "Library System";
}

$db = new mysqli('localhost', 'lib_user', 'datalog15', 'lib');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$lu = new l_user();
$lu->set_db($db);
$id=$lu->getIdByLoggedIP(@getIP());
$name="guest";
if($id!=0){
    $lu->loadById($id);
    $name=$lu->get_name();  
}

$db->set_charset("utf8");
?>