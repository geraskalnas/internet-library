<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Library system</title>  
  <link rel="stylesheet" href="css/style.css">  
</head>
<body>
<?php

require_once("config.php");
require_once("classes.php");

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$lu = new l_user();

$lu->set_db($db);

$id=$lu->getIdByLoggedIP(@getIP());

$name="guest";
if($id!=0){
    $lu->loadById($id);
    $name=$lu->get_name();  
}

$l = new l_book();
$l->set_db($db);

//$l->set_name("Math book");
//$l->set_author("Iam");
//$l->set_year("2018");

//$sql=$l->commit();

$l->loadById(2);
$autorius    = $l->get_author();
$pavadinimas = $l->get_name();
$imgPath     = $l->get_imgPath();

echo "";
    //echo "<img src='" . $imgPath . "'style='width: 100%;height: auto;'>";

?>

  <div class="topnav">
    <div>
        <a class="active" href="index.php">Pradžia</a>
 	    <a href="classes.php?test=1">Testing</a>
        <a href="login.php">Prisijungti</a>
 	    <a href="../adminer.php">Adminer</a>
    </div>
    <div>
      <p><?php echo $name; ?></p>
    </div>
  </div>
  <div class="wrapper">
   
    
   <div class="sidebar" id="l">
    <h3>Paskutinės 10:</h3><br>
    <?php
    $sql = "SELECT name, author FROM books ORDER BY id desc LIMIT 10;";
    if (!$result = $db->query($sql)) {
        die('There was an error running the query [' . $db->error . ']');
    }
    while ($row = $result->fetch_assoc()){
        echo $row["author"] . " „" . $row["name"] . "“<br><br>";
    }
    ?>
  </div>
        <div class="main">
            <div id="knygos">
                <?php
				$sql = "SELECT name, author, imgPath FROM books ORDER BY id desc LIMIT 10;";
				if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()){
					echo "<div>";
					echo $row["author"] . " „" . $row["name"] . "“<br><br>";
					echo "<img src='" . $row["imgPath"] . "'style='width: 100%;height: auto;'>";
					echo "</div>";
				}			
				
				?>
            </div>
            <div class="sidebar">

            </div>

        </div>
  <div class="sidebar" >

  </div>  

  
</div>
</body>
</html>
