<?php
require_once("classes.php");
require_once("config.php");
require_once("pre.php");


$content= "<div class=\"bei\">";
if(isset($_GET["out"]) && $_GET["out"]==1){
    $id=$lu->logoutByIP(@getIP());
    $content.="Logged out.";
}else if($name!="guest"){
    $content.= $name." logged.";
}else if(!(isset($_POST["sub"]) && $_POST["sub"]=="s")){
    $form = new Template("templates/login_form.t");
	$content.= $form->output();
}else{
    $id=$lu->check($_POST["name"], md5($_POST["password"]), @getIP(), true);
    
    if($id!=0){
        $content.= $_POST["name"]." logged.";
    }else $content.="Wrong information.";
}

$content.="</div>";
$layout->set("content", $content);
$name="guest";
if($id!=0){
    $lu->loadById($id);
    $name=$lu->get_name();  
}

$layout->set("username", $name);
echo $layout->output();
?>
