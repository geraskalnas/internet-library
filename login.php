<?php
?>
<html>
<head></head>
<body>
<?php
require_once("config.php");
require_once("classes.php");

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$l = new l_user();

$l->set_db($db);

$id=$l->getIdByIP(@getIP());

if($id!=0){
    $l->load($id);
    $out=$l->get_name();  
}

if(!empty($out)){
    echo $out." logged.";
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
