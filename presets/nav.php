<?php
require_once("config.php");
require_once("classes.php");

$page=$_SERVER['REQUEST_URI'];
$a="class=\"active\" ";



$lu = new l_user();

$lu->set_db($db);

$id=$lu->getIdByLoggedIP(@getIP());

$name="guest";
if($id!=0){
    $lu->loadById($id);
    $name=$lu->get_name();  
}
?>

<div class="topnav">
    <div>
        <a <?php if(!(stripos($page, 'classes.php') !== false || stripos($page, 'login.php') !== false)) echo $a;?>href="index.php">Pradžia</a>
 	    <a <?php if(stripos($page,'classes.php') !== false) echo $a;?>href="classes.php?test=1">Testing</a>
        <a <?php if(stripos($page,'login.php') !== false) echo $a;?>href="login.php">Prisijungti</a>
 	    <a href="../adminer.php">Adminer</a>
    </div>
    <div>
      <p><?php echo $name; ?></p>
    </div>
</div>