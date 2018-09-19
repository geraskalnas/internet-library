<?php
//phpinfo();
class l_book{
  //1.Variables
  //1.1.Meta
  private $name  = "boom";
  private $author= "";
  private $year  = "";
  //2.Functions
  //2.1.Meta
  function get_name(){
    echo $this->name;
  }
  function get_author(){
    echo $this->author;
  }
  function get_year(){
    echo $this->year;
  }
  function set_name($value){
    $this->name=$value;
  }
  function set_author($value){
    $this->author=$value;
  }
  function set_year($value){
    $this->year=$value;
  }
}
$l= new l_book();
//$l->name="da";
//echo $l->name;
$l->set_name("asdaA");
$l->get_name();
?>