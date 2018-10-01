<?php

$db = new mysqli('db4free.net', 'lib_user', 'datalog15', 'library_system11');
 
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

class l_book{
  //1.Variables
  //1.1.Meta
  private $name  = "";
  private $author= "";
  private $year  = "";
  private $inDB=false;
  public $db = false;
  //2.Functions
  //2.1.Meta
  //2.1.1.Get
  function get_name(){
    echo $this->name;
  }
  function get_author(){
    echo $this->author;
  }
  function get_year(){
    echo $this->year;
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
    $sql = $this->inDB?"UPDATE books SET ":"INSERT INTO books (name, author, year)  VALUES ('asddddddd', 'man', '2018');";
    if(!$result = $this->db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }
  }
}
$l= new l_book();
$l->set_db($db);

$l->set_name("asdaA");
$l->get_name();
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

  </div>

  <div class="sidebar">

  </div>
</div>
</body>
</html>
