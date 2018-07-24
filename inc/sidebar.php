<?php

function makeSidebar($pathToRoot)  {
  $tableName = 'Events';
  $headers = NULL;
  $conditions = "Reoccurring='0' LIMIT 5";

  $result = queryDB($tableName, $headers, $conditions);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      echo "<div class='card'>";
      printf("<h3><a href='%sschedule/event.php?post=%s'>%s</a></h3>", $pathToRoot, $row['ID'], $row['Name']);
      $textDay = getTextDate($row['Date']);
      printf('<h4>On %s at %s</h4>', $textDay, convertTime($row['Time']));
      printf('<p>%s</p>', $row['Description']);
      echo "</div>";
		}
	}
}



?>

<div class="rightcolumn">
  <div class="card">
    <h1>Bridge</h1>
    <h1>Canasata</h1>
    <h1>Scrabble</h1>
    <div class="fakeimg" style="height:100px;">Image</div>
    <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
  </div>
  <?php makeSidebar($pathToRoot); ?>
  <div class="card">
    <h3>Follow Me</h3>
    <p>Some text..</p>
  </div>
</div>
