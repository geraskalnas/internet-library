<?php

$db = new mysqli('db4free.net', 'lib_user', 'datalog15', 'library_system11');
 
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

class l_book{
  //1.Variables
  //1.1.Meta
  public $name  = "";
  public $author= "";
  public $year  = "";
  private $inDB=false;
  private $db = false;
  //2.Functions
  //2.1.Meta
  //2.1.1.Get
  function get_name(){
    return $this->name;
  }
  function get_author(){
    return $this->author;
  }
  function get_year(){
    return $this->year;
  }
  //2.1.2.Set
  function set_name($value){
    $this->name=$value;
  }
  function set_author($value){
    $this->author=$value;
  }
  function set_year($value){
    $this->year=$value;
  }
  function set_db(&$value){
    $this->db=$value;
  }
  //2.2.Control
  function rreset($fdb=false){
    $this->name  = "";
    $this->author= "";
    $this->year  = "";
    $this->inDB=false;
    if($fdb){$this->db;}
  }
  function commit(){
    $sql = $this->inDB?"UPDATE books SET ":"INSERT INTO books (name, author, year)  VALUES ('" . $this->get_name() . "', '" . $this->get_author() . "', '" . $this->get_year() . "');";
    if(!$result = $this->db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }
  }
}
$l= new l_book();
$l->set_db($db);

$l->set_name("Math book");

$l->commit();

//while($row = $result->fetch_assoc()){
//    echo $row['name'] . '<br />';
//}
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

  </div>
  <div class="main">
<?php  echo $l->get_name(); ?>
  </div>

  <div class="sidebar">

  </div>
</div>
</body>
</html>
