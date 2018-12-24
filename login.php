<?php
include_once("presets/head.php");
echo "<body>";
include_once("presets/nav.php");

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$l = new l_user();

$l->set_db($db);

$id=$l->getIdByLoggedIP(@getIP());

if($id!=0){
    $l->loadById($id);
    $out=$l->get_name();  
}

if(!empty($out)){
    echo $out." logged.";
}else if(isset($_GET["out"]) && $_GET["out"]==1){
    $id=$l->logout($uid, @getIP());
}else if(!(isset($_POST["sub"]) && $_POST["sub"]=="s")){
    echo '<form method="POST">';
    echo '<label>Vardas: </label>';
    echo '<input type="text" name="name">';
    echo '<br>';
    echo '<label>Slaptažodis: </label>';
    echo '<input type="password" name="password">';
    echo '<input type="submit" name="sub" value="s">';
    echo '</form>';
}else{
    $id=$l->check($_POST["name"], md5($_POST["password"]), @getIP(), true);
    
    if($id!=0){
        echo $_POST["name"]." logged.";
    }else echo "Wrong information.";
}
?>
</body>
</html>
