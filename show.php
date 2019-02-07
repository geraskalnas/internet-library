<?php
require_once("classes.php");
require_once("config.php");
require_once("pre.php");

/*
Pagrindas
|-Virsus
|-Ivynioklis
   |-Sonine juosta
   |-Knygos
*/

//Pagrindas
	//"ivynioklis"
			//Knygos
			$bookO->loadById($_GET["id"]);
            $book=new Template("templates/show_book.t");
				$book->set("name", $bookO->get_name());
				$book->set("author", $bookO->get_author());
				$book->set("imgUrl", $bookO->get_imgPath());
				$book->set("pdfUrl", $bookO->get_pdfPath());
            $layout->set("content", $book->output());
echo $layout->output();
?>
