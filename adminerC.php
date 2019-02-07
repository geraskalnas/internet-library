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

$ra=array();
function analyze($dat, &$ra, $s="", $i=1){
    foreach($dat as $key=>$val){
        if(!is_array($val)){
            array_push($ra, array($s.($i==1?$key:"[$key]"), $val));
        }
        else{
            analyze($val, $ra, $s.($i==1?$key:"[$key]"), $i+1);
        }
    }
    
}

$l=array(array("uswm", "c/uswm.json"));

foreach($l as $i){
    $name=$i[0];
    $url=$i[1];

    $dat=json_decode(file_get_contents($url), true);
    analyze($dat, $ra);
    $content='<form action="../adminer.php" method="post">';
    foreach($ra as $item){
        $path=$item[0];
        $value=$item[1];
        $content.="<input type=\"hidden\" name=\"". htmlspecialchars($path) ."\" value=\"". htmlspecialchars($value) ."\">";
    }
    $content.="<input type=\"submit\" name=\"$name\">";
    $content.="</form>";
    $content.="</br>";
}

$layout->set("content", $content);
echo $layout->output();
?>
