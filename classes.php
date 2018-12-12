<?php
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
        if ($this->inDB == false) {
            $sql = "SELECT MAX(id)+1 FROM books;";
            echo $sql;
            if (!$result = $this->db->query($sql)) {
                die('There was an error running the query [' . $this->db->error . ']');
            }
            $this->inDB=true;
            @$this->id=$result->fetch_assoc()["MAX(id)+1"];
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


class l_user
{
    //1.Variables
    //1.1.Meta
    private $id = 0;
    private $name = "";
    private $hash = "";
    private $inDB = false;
    private $db = false;
    
    function get_id()
    {
        if ($id == 0) {
            $sql = $inDB?"SELECT id FROM users WHERE name = ".$this->get_name()." AND hash = ".$this->get_hash().";":"SELECT MAX(id)+1 FROM users;";
            if (!$result = $this->db->query($sql)) {
                die('There was an error running the query [' . $this->db->error . ']');
            }
            $this->id=$result->fetch_assoc()["id"];
        }
        return $this->id;
        
    }
    
    
  
}

if(isset($_GET["test"]) && $_GET["test"]=="1"){
    require_once("config.php");
    echo "start\n";
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    
    $l = new l_book();
    $l->set_db($db);
    
    $l->load(1);
    echo $l->get_name()."\n";
    $l->rreset(false);
    
    $l->set_name("asda");
    echo $l->get_id();
}
?>