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
		$sidebar->set("title", "Paskutines 10:");
			$sql = "SELECT id, name, author FROM books ORDER BY id desc;";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()){
				$book = new Template("templates/sidebarBookLink.t");
				$book->set("name", $row["author"]." „".$row["name"]."“");
				$book->set("url", "show.php?id=".$row["id"]);
				$booksTemplates[]=$book;
			}
			$books = Template::merge($booksTemplates);
			$sidebar->set("content", $books);
			$wrapper->set("sidebar", $sidebar->output());
			unset ($booksTemplates);
			//Knygos
			$sep=isset($_GET["size"])?$_GET["size"]:5;
			$p=isset($_GET["page"])?$_GET["page"]-1:0;
			if($p<0) $p=0;
			if($sep<2) $sep=5;
			$sql = "SELECT name, author, imgPath FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
			if (!$result = $db->query($sql)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row = $result->fetch_assoc()){
				$book = new Template("templates/booksBook.t");
				$book->set("name", $row["name"]);
				$book->set("author", $row["author"]);
				$book->set("url", "show.php?id=".$row["id"]);
				$book->set("imgUrl", $row["imgPath"]);
				$booksTemplates[]=$book;
			}
			$books = Template::merge($booksTemplates);
			$wrapper->set("books", $books);
		$layout->set("content", $wrapper->output());
echo $layout->output();
?>
