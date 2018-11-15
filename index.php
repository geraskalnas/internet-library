<?php

$db = new mysqli('db4free.net', 'lib_user', 'datalog15', 'library_system11');

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
  <div class="wrapper">
  <div class="sidebar">
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
    <?php echo $autorius . " „" . $pavadinimas . "“"; ?>
   <br>
    

  </div>

  <div class="sidebar">

  </div>
</div>
</body>
</html>
