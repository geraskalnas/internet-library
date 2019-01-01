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
			$bookO->loadById($_GET["id"]);
            $book=new Template("templates/show_book.t");
				$book->set("name", $bookO->get_name());
				$book->set("author", $bookO->get_author());
				$book->set("imgUrl", $bookO->get_imgPath());
        $wrapper->set("books", $book->output());
		$layout->set("content", $wrapper->output());
echo $layout->output();
?>
