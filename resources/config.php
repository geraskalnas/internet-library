<?php
 
/*
    The important thing to realize is that the config file should be included in every
    page of your project, or at least any page you want access to these settings.
    This allows you to confidently use these settings throughout a project because
    if something changes such as your database credentials, or a path to a specific resource,
    you'll only need to update it here.
*/
$cfile="remotemysql.json";
$dat=json_decode(file_get_contents(realpath(dirname(__FILE__))."/db/".$cfile), true);
$db = new mysqli($dat["auth"]["server"], $dat["auth"]["username"], $dat["auth"]["password"], $dat["auth"]["db"]);
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$db->set_charset("utf8");
unset($cfile, $dat);

require("library/classes.php");

$lbook = new l_book();
$lbook->set_db($db);
$luser = new l_user();
$luser->set_db($db);
$id=$luser->getIdByLoggedIP(@getIP());
$username="guest";
if($id!=0){
    $luser->loadById($id);
    $name=$lu->get_name();  
}
defined("USERNAME")
	or define("USERNAME", $username);
unset($id, $username);


$config = array(
    "db" => &$db,
    "urls" => array(
        "baseUrl" => "http://example.com"
    ),
    "handlers" => array(
    	"user" => &$luser,
    	"book" => &$lbook
    ),
    "paths" => array(
        "resources" => "./",
        "images" => array(
            "content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
            "layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
        )
    )
);
 
/*
    I will usually place the following in a bootstrap file or some type of environment
    setup file (code that is run at the start of every page request), but they work 
    just as well in your config file if it's in php (some alternatives to php are xml or ini files).
*/
 
/*
    Creating constants for heavily used paths makes things a lot easier.
    ex. require_once(LIBRARY_PATH . "Paginator.php")
*/

defined("LIBRARY_PATH")
    or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));
 
/*
    Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);
 
?>