<?php

//show the days of the week
//put down the time slots for each one
function doDisplay($weekdays)  {
  foreach($weekdays as $day)  {
    printf("<div class='day' id='%s'>", $day);
      printf("<div class='dayHeader'><h3 class='centerText'>%s</h3></div>", $day);
      showTimeSlots($day);
      printf("<form><input type='time' id='%sTime' required>", $day);
      printf("<button type='button' onclick='runAJAX(%s, %s)'>Add New Time</button></form>", '"addTime"', '"'. $day . '"');
    echo "</div>";
  }
}

//
function showTimeSlots($day)  {
  $table = "TimeSlots";
  $headers = NULL;
  $conditions = sprintf("Day='%s'", $day);
  $result = queryDB($table, $headers, $conditions);

  if ($result->num_rows > 0) {
		// output data of each row
		$times = array();
		$id = array();
		while($row = $result->fetch_assoc()) {
			array_push($times, $row['Time']);
			$id[$row['Time']] = $row['ID'];
		}

		$times = bubbleSort($times);

		foreach($times as $time)  {
			$printTime = convertTime($time);

			echo '<h4>' . $printTime;
      printf("<form><button type='button' onclick='runAJAX(%s, %s)'>Remove</button></form>", '"removeTime"', '"' . $id[$time] . '"');
			echo '</h4>';
			showEvents($day, $time);
		}
	}
  else echo "0 results";
}

//this is a specific function that get ran inside the above function
//given a day and a time, show all the reoccurring events in a certain manner
//..specifically for the weekly schedule
function showEvents($day, $time)  {

  //query the db for all reoccurring events at a certain time and day
	$table = "Events";
  $headers = NULL;
  $conditions = sprintf("Day='%s' AND Time='%s' AND Reoccurring='1'", $day, $time);
  $result = queryDB($table, $headers, $conditions);

	if ($result->num_rows > 0) {
		// output data of each row
		//echo '<ul>';
		while($row = $result->fetch_assoc()) {
			if($row['Type'] == 'Game') $symbol = $GLOBALS['symbols']['spade'];
			else if($row['Type'] == 'Lesson') $symbol = $GLOBALS['symbols']['heart'];
			else if($row['Type'] == 'Other') $symbol = $GLOBALS['symbols']['diamond'];
			else $symbol = $GLOBALS['symbols']['club'];
			echo $symbol . "<a href='event.php?post=" . $row['ID'] . "'>" . $row['Name'] . '</a><br>';
		}
		//echo '</ul>';
	}
}

function showReoccurringEvents()  {
	$table = 'Events';
	$headers = array('Name', 'Time', 'Day', 'Type');
	$conditions = "Reoccurring = '1'";

	$results = queryDB($table, NULL, $conditions);

	$tableAttributes = "id='scheduleTable' class='center'";
	makeTableFromResult($results, $headers, $tableAttributes, TRUE);
}

function getTimes($day)  {
  $table = 'TimeSlots';
	$conditions = sprintf("Day='%s'", $day);

  $result = queryDB($table, NULL, $conditions);

  if ($result->num_rows > 0) {
		// output data of each row
		$times = array();
		while($row = $result->fetch_assoc()) {
			array_push($times, $row['Time']);
		}

		$times = bubbleSort($times);

		foreach($times as $time)  {
			$printTime = convertTime($time);
      printf("<option value='%s'>%s</option>", $time, $printTime);
		}
	}
  else echo "0 results";
}

function showEvent($pathToRoot)  {
  $id = $_GET['post'];

  $tableName = 'Events';
  $headers = NULL;
  $conditions = sprintf('ID=%s', $id);

  $result = queryDB($tableName, $headers, $conditions);

  //print_r($results);
  if ($result->num_rows > 0) {
		// output data of each row

		while($row = $result->fetch_assoc()) {
			printf('<h1>%s</h1>', $row['Name']);
      if($row['Reoccurring'] == '1')  {
        printf('<h3>On %s ', $row['Day']);
      }
      else  {
        $textDay = getTextDate($row['Date']);
        printf('<h3>On %s ', $textDay);
      }
      printf('at %s</h3>', convertTime($row['Time']));

      printf('<p>%s</p>', $row['Description']);

      printf("<a href='%saddReservation.php?id=%s'>Click Here</a> To Make A Reservation", $pathToRoot, $row['ID']);
      printf("<br><a href='%sschedule/editEvent.php?id=%s'>Click Here</a> To Edit This Event", $pathToRoot, $row['ID']);

		}
  }
}

function getEvent($id)  {
  $table = 'Events';
  $headers = NULL;
  $condition = sprintf("ID=%s", $id);

  $result = queryDB($table, $headers, $condition);

  if ($result->num_rows > 0) {
		// output data of each row

		while($row = $result->fetch_assoc()) {
			return $row;
		}
  }
}




?>
