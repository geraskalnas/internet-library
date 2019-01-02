<?php
include("templateEngine.php");
$layout = new Template("templates/layout.t");
$layout->set("title", $PAGE_TITLE);
$layout->set("username", $name);

$layout->set("sidebarTitle", "Paskutines 10:");
$sql = "SELECT id, name, author FROM books ORDER BY id desc;";
if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}
while ($row = $result->fetch_assoc()){
	$book = new Template("templates/sidebarBookLink.t");
	$book->set("author", $row["author"]);
	$book->set("name", $row["name"]);
	$book->set("url", "show.php?id=".$row["id"]);
	$booksTemplates[]=$book;
}
$books = Template::merge($booksTemplates);
$layout->set("sidebarContent", $books);
unset ($booksTemplates);
?>
