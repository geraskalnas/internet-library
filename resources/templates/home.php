<h2>Home Page</h2>
<?php
    $sql = "SELECT name, author, imgPath, id FROM books WHERE blocked=0 ORDER BY id desc LIMIT ".$p*$sep.", $sep;";
	if (!$result = $db->query($sql)) {
		array_push($errors, 'There was an error running the query [' . $db->error . ']');
	}else{
		while ($row = $result->fetch_assoc()){
			echo '<div class="bei" style="max-width: 15%;">';
	    	echo '<a href="'."index.php?id=".$row["id"].'">'.$row["author"].' „'.$row["name"].'“</a>';
	    	echo '<br><br>';
	    	echo '<img src="'.$row["imgPath"].'" style="width: 100%;height: auto;">';
			echo '</div>';
		}
	}
?>