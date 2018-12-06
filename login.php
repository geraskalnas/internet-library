<?php
?>
<html>
<head></head>
<body>
<?php
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
  //$db = new mysqli('db4free.net', 'lib_user', 'datalog15', 'library_system11');
  $db = new mysqli('localhost', 'id4519783_user2', '11Asilamsne', 'id4519783_lib_books');
  if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  
  $sql="SELECT uid FROM lr WHERE tim > CURRENT_TIME() - INTERVAL 60 MINUTE AND DAT=CURRENT_DATE() AND ip='".getIP()."';";
  if (!$result = $db->query($sql)) {
    die('There was an error running the query [' . $db->error . ']');
  }
  $out=$result->fetch_assoc()["uid"];
  
  if(!empty($out)){
        $sql = "SELECT name FROM users WHERE id=".$out.";";
        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
        $out=$result->fetch_assoc()["name"];
  }
  
  
  
  if(!empty($out)){
      echo $out." logged.";
  }else if(!(isset($_POST["sub"]) && $_POST["sub"]=="s")){
      echo '<form method="POST">';
      echo '<label>Vardas: </label>';
      echo '<input type="text" name="name">';
      echo '<br>';
      echo '<label>Slaptažodis: </label>';
      echo '<input type="password" name="password">';
      echo '<input type="submit" name="sub" value="s">';
      echo '</form>';
  }else{
        $sql = "SELECT name, id FROM users WHERE name='".$_POST["name"]."' AND hash='".md5($_POST["password"])."';";
        if (!$result = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        }
        $out=$result->fetch_assoc();
        $id=$out["id"];
        $out=$out["name"];
        
        if(!empty($out)){
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }
            $sql = "INSERT INTO lr (uid, dat, tim, ip) VALUES(".$id.", CURRENT_DATE(), CURRENT_TIME(), '".getIP()."')";
            //echo $sql;
            if (!$result = $db->query($sql)) {
                die('There was an error running the query [' . $db->error . ']');
            }
            //$out=$result->fetch_assoc()["name"];
        
            echo $out." logged.";
        }else echo "Wrong information.";
  }
?>
</body>
</html>
