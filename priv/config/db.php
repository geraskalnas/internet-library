<?php

$db_host="";
$db_username="";
$db_password="";
$db_database="";

@$jungtis = new mysqli($db_host, $db_username, $db_password, $db_database);
@$jungtis->set_charset("utf8_general_ci");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
set_exception_handler(function($e) {
  error_log($e->getMessage());
});

if ($jungtis->connect_error) {
	/*require_once(FUNKCIJU_VIETA . "/sablonuFunkcijos.php");
	$kintamieji = array(
		'err' => 'Nepavyksta prisijungti prie duomenų bazės'
	);
	SudarytiTurini('pagrindiniai/klaida.php', $kintamieji);
	*/
	return 'Nepavyksta prisijungti prie duomenų bazės';
}
return 0;

?>
