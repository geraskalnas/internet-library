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
	$wrapper = new Template("templates/wrapper.t");
		//Sonine juosta
		
			//Knygos
			$sep=isset($_GET["size"])?$_GET["size"]:5;
			$p=isset($_GET["page"])?$_GET["page"]-1:0;
			if($p<0) $p=0;
			if($sep<2) $sep=5;
			$sql = "SELECT name, author, imgPath, id FROM books ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
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
