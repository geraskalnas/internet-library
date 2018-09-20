<?php

$db = new mysqli('localhost', 'lib_user', 'datalog15', 'librarys_system11');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

class l_book{
  //1.Variables
  //1.1.Meta
  private $name  = "boom";
  private $author= "";
  private $year  = "";
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
  //2.2.Control
  function commit(){
    
  }
}
$l= new l_book();
//$l->name="da";
//echo $l->name;
$l->set_name("asdaA");
$l->get_name();
?>
