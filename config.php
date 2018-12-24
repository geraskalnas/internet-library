<?php

$db = new mysqli('localhost', 'lib_user', 'datalog15', 'lib');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$db->set_charset("utf8");
?>