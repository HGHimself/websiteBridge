<?php

include "database.php";





  function printScheduleDate($date)  {
    $mysqli = setUpConnection();

    if(!$mysqli)  echo '<br>The connection didnt work!';
    else  {
			$dir = array("N/S", "E/W");
			foreach($dir as $direction)  {

				//echo "<div class='column'>";
	      if($date == NULL) $sql = sprintf("SELECT * FROM Reservation WHERE Direction='%s'", $direction);
	      else $sql = sprintf("SELECT * FROM Reservation WHERE date='%s' AND Direction='%s'", $date, $direction);

				$result = $mysqli->query($sql);
				//echo sprintf("<h3>%s</h3>", $direction);
	      if ($result->num_rows > 0) {
	        echo sprintf("<div class='twocolumn' style='overflow-x:auto;''><label>%s</label><table id='scheduleTable_%s'>", $direction, $direction);

					echo "<tr><th>Player</th><th>Partner</th><th>Event</th><th></th></tr>";
	        // output data of each row
	        while($row = $result->fetch_assoc()) {
	          $id = $row['ID'];
	          $form = "<form action='' method='post'><input type='submit' name='remove' value='Remove'><input type='hidden' name='id' value='" . $id . "'></form>";
						$r = sprintf("<tr><td>%s</td><td>%s</td><td>%s</td>", $row['Player'], $row['Partner'], $row['Event']);
	          $r .= "<td>" . $form . "</td></tr>";
	          echo $r;
	        }
	        echo "</table></div>";
	      }
	      else  echo "0 results";

				//echo "</div>";
			}
			$mysqli->close();
    }
  }









?>
