<?php
    require_once("resources/config.php");
    require_once(LIBRARY_PATH . "/templateFunctions.php");
    
    $action=isset($_GET["action"])?$_GET["action"]:"home";
    
    $variables = array(
        'db' => $db,
        'username' => USERNAME
    );
    
    switch($action){
    	case "home":
    		$sep=isset($_GET["size"])?$_GET["size"]:5;
			$p=isset($_GET["page"])?$_GET["page"]-1:0;
			if($p<0) $p=0;
			if($sep<2) $sep=5;
			$variables["p"]=$p;
			$variables["sep"]=$sep;
    		break;
    	case "database":
    		break;
    	default:
    		$action = "error";
    }
    
    $variables["title"] = "LIBEPIC - ".$action;
    
    renderLayoutWithContentFile($action.".php", $variables);
?>
