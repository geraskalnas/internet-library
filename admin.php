<?php
require_once("classes.php");
require_once("config.php");
require_once("pre.php");

//if(!$lu->isAdmin()) die("only admin");
if(($lu->get_type())!="admin") {
    $layout->set("content", "only admin");
    echo $layout->output();
    die();
}

function validi($i){
	if($i!=0){
		return true;
	}
	return false;
}	

$a=isset($_GET["action"])?$_GET["action"]:"manage";
$t=isset($_GET["type"])?$_GET["type"]:"none";
$i=isset($_GET["i"])?$_GET["i"]:0;

if(!(($a=="show" || $a=="edit") && ($t=="books" || $t=="users") && validi($i)) && !($a=="list" && ($t=="books" || $t=="users")) && $a!="manage"){
	$a="manage";
}

$content="";

switch($a){
	case "manage":
	$content.= "<a href=\"admin.php?action=list&type=books\">books</a></br>\n";
	$content.= "<a href=\"admin.php?action=list&type=users\">users</a></br>\n";
	break;
	case "list":
	$sep=isset($_GET["size"])?$_GET["size"]:5;
	$p=isset($_GET["page"])?$_GET["page"]-1:0;
	if($p<0) $p=0;
	if($sep<2) $sep=5;
	if($t=="books"){
		$sql = "SELECT name, author, id FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()){
			$content.= "<a href=\"admin.php?action=show&type=books&i=".$row["id"]."\">". $row["author"] . " - \"". $row["name"] ."\"</a></br>\n";
		}
	}else{
		$sql = "SELECT name, id FROM users ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()){
			$content.= "<a href=\"admin.php?action=show&type=users&i=".$row["id"]."\">". $row["name"] ."</a></br>\n";
		}
	}
	$content.= "</br>\n</br>\n";
	if($p>0) $content.= "<a href=\"admin.php?action=list&type=". $t . ($p==1?"":("&page=". ($p))) ."\">previous</a>	";
	$content.= "<a href=\"admin.php?action=list&type=". $t ."&page=". ($p+2) ."\">next</a></br>\n";
	break;
	case "show":
	if($t=="books"){
		
	}else{
		
	}
	break;
}

$layout->set("content", $content);
echo $layout->output();
?>
