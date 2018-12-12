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
        if ($this->inDB == false) {
            $sql = "SELECT MAX(id)+1 FROM users;";
            echo $sql;
            if (!$result = $this->db->query($sql)) {
                die('There was an error running the query [' . $this->db->error . ']');
            }
            @$this->id=$result->fetch_assoc()["MAX(id)+1"];
        }
        return $this->id;
    }
    function get_name(){
        return $this->name;
    }
    function get_hash(){
        return $this->hash;
    }
    function set_name($value)
    {
        $this->name = $value;
    }
    function set_hash($value)
    {
        $this->hash = $value;
    }
    function set_db(&$value)
    {
        $this->db = $value;
    }
    function rreset($fdb = true)
    {
        $this->id=0;
        $this->set_name("");
        $this->set_hash("");
        $this->inDB = false;
        if($fdb){$this->db=false;}
    }
    function commit()
    {
        $this->get_id();
        $sql = $this->inDB ? "UPDATE users SET name = '".$this->get_name()."', hash = '".$this->get_hash()."';" : "INSERT INTO users (name, hash, registredIn)  VALUES ('" . $this->get_name() . "', '" . $this->get_hash() . "', CURDATE());";
        if (!$result = $this->db->query($sql)) {
            die('There was an error running the query [' . $this->db->error . ']');
        }
        return $sql;
    }
    function load($id)
    {
        $sql = "SELECT name, hash FROM users WHERE id='" . $id . "';";
        if (!$result = $this->db->query($sql)) {
            die('There was an error running the query [' . $this->db->error . ']');
        }
        $row = $result->fetch_assoc();
        $this->id=$id;
        $this->set_name($row['name']);
        $this->set_hash($row['hash']);
        $this->inDB=true;
        return $sql;
    }  
}

if(isset($_GET["test"]) && $_GET["test"]=="1"){
    require_once("config.php");
    echo "start\n";
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    
    $l = new l_user;
    $l->set_db($db);
    $l->set_name("asda");
    $l->set_hash("7815696ecbf1c96e6894b779456d330e");
    $l->commit();
    //echo $l->get_name()."\n";
    //echo $l->get_hash()."\n";
}
?>