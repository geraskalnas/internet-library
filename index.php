<?php
 
    require_once("resources/config.php");
 
    require_once(LIBRARY_PATH . "/templateFunctions.php");
 
    
    $sep=isset($_GET["size"])?$_GET["size"]:5;
	$p=isset($_GET["page"])?$_GET["page"]-1:0;
	if($p<0) $p=0;
	if($sep<2) $sep=5;
	
     
    // Must pass in variables (as an array) to use in template
    $variables = array(
        'sep' => $sep,
        'p' => $p,
        'db' => $db,
        'username' => USERNAME
    );
     
    renderLayoutWithContentFile("home.php", $variables);
 
?>
