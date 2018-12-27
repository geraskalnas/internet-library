<?php
include_once("presets/head.php");
echo "<body>";
include_once("presets/nav.php");

//if(!$lu->isAdmin()) die("only admin");
if($name!="admin") die("only admin</body></html>");

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

switch($a){
	case "manage":
	echo "<a href=\"admin.php?action=list&type=books\">books</a></br>\n";
	echo "<a href=\"admin.php?action=list&type=users\">users</a></br>\n";
	break;
	case "list":
	$sep=isset($_GET["size"])?$_GET["size"]:5;
	$p=isset($_GET["page"])?$_GET["page"]-1:0;
	if($p<0) $p=0;
	if($sep<2) $sep=5;
	if($t=="books"){
		$sql = "SELECT name, author FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()){
			echo "<a href=\"admin.php?action=show&type=users&i=".$row["id"]."\">". $row["author"] . " - \"". $row["name"] ."\"</a></br>\n";
		}
	}
}
?>
</body>
</html>