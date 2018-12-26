<?php
include_once("presets/head.php");
echo "<body>";
include_once("presets/nav.php");

?>

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
				$sep=isset($_GET["size"])?$_GET["size"]:5;
				$p=isset($_GET["page"])?$_GET["page"]-1:0;
				$sql = "SELECT name, author, imgPath FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
				if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				while ($row = $result->fetch_assoc()){
					echo "<div>";
					echo $row["author"] . " „" . $row["name"] . "“<br><br>";
					echo "<img src='" . $row["imgPath"] . "'style='width: 100%;height: auto;'>";
					echo "</div>\n";
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
