<?php

require_once("config.php");

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

class l_book
{
    //1.Variables
    //1.1.Meta
    private $id = 0;
    private $name = "";
    private $author = "";
    private $year = "";
    private $imgPath = "";
    private $inDB = false;
    private $db = false;
    //2.Functions
    //2.1.Meta
    //2.1.1.Get
    function get_id()
    {
        if ($id == 0) {
            $sql = $inDB?"SELECT MAX(id) FROM books;":"SELECT MAX(id)+1 FROM books;";
            if (!$result = $this->db->query($sql)) {
                die('There was an error running the query [' . $this->db->error . ']');
            }
            $this->id=$result->fetch_assoc()["id"];
        }
        return $this->id;
        
    }
    function get_name()
    {
        return $this->name;
    }
    function get_author()
    {
        return $this->author;
    }
    function get_year()
    {
        return $this->year;
    }
    function get_imgPath()
    {
        return $this->imgPath;
    }
    //2.1.2.Set
    function set_name($value)
    {
        $this->name = $value;
    }
    function set_author($value)
    {
        $this->author = $value;
    }
    function set_year($value)
    {
        $this->year = $value;
    }
    function set_imgPath($value)
    {
        $this->imgPath = $value;
    }
    function set_db(&$value)
    {
        $this->db = $value;
    }
    //2.2.Control
    function rreset($fdb = true)
    {
        $this->id=0;
        $this->set_name("");
        $this->set_author("");
        $this->set_year("");
        $this->set_imgPath("");
        $this->inDB = false;
        if($fdb){$this->db=false;}
    }
    function commit()
    {
        $this->get_id();
        $sql = $this->inDB ? "UPDATE books SET " : "INSERT INTO books (name, author, year, registredIn)  VALUES ('" . $this->get_name() . "', '" . $this->get_author() . "', '" . $this->get_year() . "', CURDATE());";
        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $this->db->error . ']');
        }
        return $sql;
    }
    function load($id)
    {
        $sql = "SELECT name, author, year, imgPath FROM books WHERE id='" . $id . "';";
        if (!$result = $this->db->query($sql)) {
            die('There was an error running the query [' . $this->db->error . ']');
        }
        $row = $result->fetch_assoc();
        $this->id=$id;
        $this->set_name($row['name']);
        $this->set_author($row['author']);
        $this->set_year($row['year']);
        $this->set_imgPath($row['imgPath']);
        $this->inDB=true;
        return $sql;
    }
}
$l = new l_book();
$l->set_db($db);

//$l->set_name("Math book");
//$l->set_author("Iam");
//$l->set_year("2018");

//$sql=$l->commit();

$l->load(2);
$autorius    = $l->get_author();
$pavadinimas = $l->get_name();
$imgPath     = $l->get_imgPath();

echo "";
    //echo "<img src='" . $imgPath . "'style='width: 100%;height: auto;'>";

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Library system</title>  
  <link rel="stylesheet" href="css/style.css">  
</head>
<body>
  <div class="topnav">
    <a class="active" href="/">Prad=ia</a>
    <a href="login.php">Prisijungti</a>
  </div>
  <div class="wrapper">
   
    
   <div class="sidebar" id="l">
    <p>Paskutinės 10:</p><br>
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
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum nec arcu nec luctus. Integer suscipit dolor mi, sit amet accumsan augue tempus nec. Vivamus feugiat sapien et lacinia tristique. Cras a turpis eu libero suscipit ullamcorper ac id augue. Donec dignissim, neque non tempor tempus, lectus nunc varius nulla, non vestibulum orci purus et justo. Donec quis metus egestas, luctus libero et, aliquam eros. Sed quis enim a mi posuere molestie eu vitae purus.

Quisque ultricies mauris metus, quis luctus sapien iaculis ac. Morbi nec arcu sem. Ut fringilla lorem non dapibus euismod. Vestibulum consectetur sodales ante, eu tempus tortor tincidunt varius. Praesent porta nec dui id ullamcorper. Nam ut laoreet eros. Vivamus quam nisi, tincidunt nec consequat sed, porttitor ac lorem. Suspendisse ac leo odio. Pellentesque nec scelerisque mauris, eu pharetra diam. Cras eget sem ac libero tempus euismod quis in nunc. Praesent tincidunt, ligula vitae porta pulvinar, magna lacus pretium tellus, eget eleifend arcu felis eu sem.

Mauris porttitor diam sapien, eu eleifend libero eleifend pulvinar. Quisque tristique dapibus lacus sit amet euismod. Pellentesque fermentum arcu sit amet mi dictum, et condimentum justo gravida. Sed semper id massa vel dapibus. Vivamus mollis odio eros, at placerat ligula fermentum sed. Praesent consectetur eu erat vel convallis. Sed interdum mattis ex nec mollis. Etiam eget diam risus.

Praesent auctor velit ante, blandit hendrerit orci porta eu. Fusce tempor sapien non urna ornare, at dictum urna tincidunt. Fusce sit amet congue quam. Integer eu dolor porttitor magna vulputate dignissim vitae sit amet est. Sed sem lorem, convallis sit amet condimentum in, rutrum ac nisi. Aenean ultrices a urna vitae tempor. Vivamus nisl justo, imperdiet ac neque mattis, finibus gravida lacus. Aliquam diam augue, laoreet quis lorem nec, blandit varius massa. In id posuere odio. Vestibulum congue tortor eget quam gravida tristique.

Phasellus eu efficitur purus. Nulla luctus commodo ipsum quis varius. Nam eget mi non odio auctor sodales. Etiam et lacinia felis, eget malesuada arcu. Ut pretium imperdiet quam aliquam egestas. Vivamus sit amet porta lectus. Donec mollis tellus et nisl egestas, in ornare dui pulvinar. Nulla blandit porttitor commodo. Aliquam et scelerisque tellus, sit amet volutpat massa.
</div>
  <div class="sidebar" >

  </div>  

  
</div>
</body>
</html>
