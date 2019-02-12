<html>
    <body>
<?php
if(file_exists('editor.config.php'))require('editor.config.php');
if(!isset($PASSWORD)){
	require('set-password.php');
	exit;
}
if(!($PASSWORD!=md5('')&&(!isset($_COOKIE['editor-auth'])||md5($_COOKIE['editor-auth'])!=$PASSWORD))){
	#unset($_COOKIE['editor-auth']);
	#setcookie('editor-autha', $value='');
	#echo '<script>document.cookie = "editor-auth=" + 0 + ";path=" + window.location.pathname + ";max-age=315360000" + (document.location.protocol === "http:" ? "" : ";secure");</script>';
	$cookie_name = 'editor-auth';
    unset($_COOKIE[$cookie_name]);
    // empty value and expiration one hour before
    $res = setcookie($cookie_name, '', time() -  3600);
	echo var_dump($_COOKIE);
	echo 'unset</br>';
}
echo 'done';
?>
        <p id='msg'></p>
    </body>
</html>