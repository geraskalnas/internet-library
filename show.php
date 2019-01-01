<?php
require_once("classes.php");
require_once("config.php");
include("templateEngine.php");

/*
Pagrindas
|-Virsus
|-Ivynioklis
   |-Sonine juosta
   |-Knygos
*/

//Pagrindas
$layout = new Template("templates/layout.t");
$layout->set("title", $PAGE_TITLE);

	$layout->set("username", $name);

	//"ivynioklis"
	$wrapper = new Template("templates/wrapper.t");
		//Sonine juosta
		$sidebar = new Template("templates/sidebar.t");
		$sidebar->set("title", "PaskutinÄ—s 10:");
			$sql = "SELECT name, author FROM books ORDER BY id desc;";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()){
				$book = new Template("templates/link.t");
				$book->set("name", $row["author"]." - ".$row["name"]);
				$book->set("spec", "");
				$booksTemplates[]=$book;
			}
			$books = Template::merge($booksTemplates);
			$sidebar->set("content", $books);
			$wrapper->set("sidebar", $sidebar->output());
			unset ($booksTemplates);
			//Knygos
			ep=isset($_GET["size"])?$_GET["size"]:5;
			$p=isset($_GET["page"])?$_GET["page"]-1:0;
			if($p<0) $p=0;
			if($sep<2) $sep=5;
			$sql = "SELECT name, author, imgPath FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()){
				$book = new Template("templates/book.t");
				$book->set("name", $row["name"]);
				$book->set("author", $row["author"]);
				$book->set("imgUrl", $row["imgPath"]);
				$booksTemplates[]=$book;
			}
			$books = Template::merge($booksTemplates);
			$wrapper->set("books", $books);
		$layout->set("content", $wrapper->output());
echo $layout->output();
?>