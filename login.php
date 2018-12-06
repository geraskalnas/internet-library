<?php
?>
<html>
<head></head>
<body>
<?php
  if(!(isset($_POST["sub"]) && $_POST["sub"]=="s")){
      echo '<form method="POST">';
      echo '<label>Vardas: </label>';
      echo '<input type="text" name="name">';
      echo '<br>';
      echo '<label>Slaptažodis: </label>';
      echo '<input type="password" name="password">';
      echo '<input type="submit" name="sub" value="s">';
      echo '</form>';
  }else{
      // Function to get the client ip address
    function getIP() {
        $ipaddress = '';
        if ($_SERVER['HTTP_CLIENT_IP'])
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if($_SERVER['HTTP_X_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if($_SERVER['HTTP_X_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if($_SERVER['HTTP_FORWARDED_FOR'])
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if($_SERVER['HTTP_FORWARDED'])
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if($_SERVER['REMOTE_ADDR'])
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
 
        return $ipaddress;
    }
      $db = new mysqli('db4free.net', 'lib_user', 'datalog15', 'library_system11');
        
        if ($db->connect_errno > 0) {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        $sql = "SELECT name FROM users WHERE name='".$_POST["name"]."' AND hash='".md5($_POST["password"])."';";
        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
        $out=$result->fetch_assoc()["name"];
        
        if(!empty($out)){
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }
            $sql = "INSERT (id, date, time) FROM ls WHERE uid='".$id."'])."';";
            if (!$result = $db->query($sql)) {
                die('There was an error running the query [' . $db->error . ']');
            }
            //$out=$result->fetch_assoc()["name"];
        
            echo $out." logged.";
        }else echo "rip";
  }
?>
</body>
</html>
