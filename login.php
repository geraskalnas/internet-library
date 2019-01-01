<?php
require_once("classes.php");
require_once("config.php");
include("templateEngine.php");

$layout = new Template("templates/layout.t");
$layout->set("title", $PAGE_TITLE);


if(isset($_GET["out"]) && $_GET["out"]==1){
    $id=$lu->logoutByIP(@getIP());
	$layout->set("content", "Logged out.");
}else if($name!="guest"){
    $layout->set("content", $name." logged.");
}else if(!(isset($_POST["sub"]) && $_POST["sub"]=="s")){
    $form = new Template("templates/login_form.t");
	$layout->set("content", $form->output());
}else{
    $id=$lu->check($_POST["name"], md5($_POST["password"]), @getIP(), true);
    
    if($id!=0){
        $layout->set("content", $_POST["name"]." logged.");
    }else $layout->set("content", "Wrong information.");
}

$name="guest";
if($id!=0){
    $lu->loadById($id);
    $name=$lu->get_name();  
}

$layout->set("username", $name);
echo $layout->output();
?>
