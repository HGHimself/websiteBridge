<?php

//populates the dropdown from months, makes the month from GET selected
function doMonths()  {
  $months = $GLOBALS['months'];
  if(isset($_GET['month']))  $month = $_GET['month'];
  else $month = getThisMonth();

  foreach($months as $m)  {
    //if the mon is the one from GET, make it selected
    if($m == $month) $selected = "id='month' selected='selected'";
    else $selected = '';
    //add that b
    printf("<option %s value='%s'>%s</option>", $selected, $m, $m);
  }
}

function doLocations()  {
  $locations = $GLOBALS['locations'];
  if(isset($_GET['location']))  $location = $_GET['location'];
  else $location = "Honors";
  echo $location;
  foreach($locations as $l)  {
    //if the loc is the one from GET, make it selected
    if($l == $location) $selected = "id='location' selected='selected'";
    else $selected = '';
    //add that b
    printf("<option %s value='%s'>%s</option>", $selected, $l, $l);
  }
}

//will create a calendar given a month and year
function doCalendar($month, $year, $location)  {

	$months = $GLOBALS['months'];
	$weekdays = $GLOBALS['weekdays'];
	$monthDays = $GLOBALS['monthDays'];

  if(findLeapYear($year) === TRUE)  {
    echo "yeet";
    $monthDays['February'] = 29;
  }

  $today = getToday();

  echo "<div class='row'>";
    echo "<div class='centerText'>";
      printf("<h2 class='dayHeader'>%s, %s</h2></div></div>", $month, $year);
    echo "</div>";
  echo "</div>";

  //find out which day of the week the first of the month occurs on
  $date = getdate(strtotime(makeDate($year, $month, '01')));
  //0 is sun, 6 is sat
  $dayNumber = $date['wday'];
  $monthNumber = $date['mon'];

	$count = 1;
	$currentMonthDays = $monthDays[$month];

  echo "<div class='dayContainer'>";
    //show the days of the week for headers
    displayDays($weekdays);

    //if its not sunday, then find which month comes before
    if($dayNumber != 0)  {
  		//the month before jan is dec
  		if($monthNumber == 1)  {
  			$monthNumber = 12;
        $year -= 1;
  		}
      else $monthNumber -= 1;

      //echo $monthNumber;
      $prevMonth = $months[$monthNumber - 1];

  		$prevMonthDays = $monthDays[$prevMonth];
  		//the date to start on is the difference between the total days of the
  		//previous month and the $dayNumber of the 1st of the month offset by 1
  		//i.e June 1st => Friday => 5
  		//so there are
  		$count = $prevMonthDays - $dayNumber + 1;
  		$class = 'notMonth';
      $flag = 0;
		  echo "<div class='row'>";
		    foreach($weekdays as $day)  {
          //if the class was set to isToday, switch it off
          if($class == 'isToday')  {
            if($flag == 0) $class = "notMonth";
            else $class = "isMonth";
          }
          //if the count is past the $prevMonthDays, switch to next month
          if($count > $prevMonthDays)  {
            $flag = 1;
            $class = 'isMonth';
            $count = 1;
            if($monthNumber == 12)  {
              $monthNumber = 1;
              $year += 1;
            }
            else $monthNumber += 1;
          }

  	      $id = makeDate($year, sprintf('%02d', $monthNumber), sprintf('%02d', $count));
          if($today == $id)  {
            $class = "isToday";
          }

          printf("<div class='day %s' id='%s'>", $class, $id);
            //increment count each time you place down a day
            printf("<a href='day.php?day=%s&location=%s'><b>%s</b></a><br>", $id, $location, $count++);
            showEvents($id, $day, $location, NULL, 'calendar');
            //if youre past the number of days, start current month
          echo "</div>"; //close day div
        }
		  echo "</div>"; //close row div
    }//END if($dayNumber != 0)

    //reset the class
    $class = 'isMonth';
    $flag = 0;
    while($count <= $currentMonthDays && $class != 'notMonth')  {
      echo "<div class='row'>";
        foreach($weekdays as $day)  {
          if($class == 'isToday')  {
            if($flag == 0) $class = "isMonth";
            else $class = "notMonth";
          }

          if($count > $currentMonthDays)  {
            $flag = 1;
            $class = 'notMonth';
            $count = 1;
            if($monthNumber == 12)  {
              $monthNumber = 1;
              $year += 1;
            }
            else $monthNumber += 1;
          }

          $id = makeDate($year, sprintf('%02d', $monthNumber), sprintf('%02d', $count));
          if($today == $id)  {
            $class = "isToday";
          }

          printf("<div class='day %s' id='%s'>", $class, $id);
   	        printf("<a href='day.php?day=%s&location=%s'><b>%s</b></a><br>", $id, $location, $count++);
            showEvents($id, $day, $location, NULL, 'calendar');
  		    echo "</div>"; //close day div
        }
		  echo "</div>"; //close row div
    }

  echo "</div>"; //close dayContainer div
}

function displayDays($weekdays)  {
  //get the weekday names down
  //echo "<div class='dayContainer'>";
    echo "<div class='row'>";
      foreach($weekdays as $day)  {
        printf("<div class='day' id='%s'>", $day);
          printf("<div class='dayHeader'><h3 class='centerText'>%s</h3></div>", $day);
        echo "</div>";
      }
    echo "</div>";
  //echo "</div>";
}

function showEvents($date, $day, $location, $time, $flag)  {

  //query the db for all reoccurring events at a certain time and day
	$table = "Events";
  $headers = NULL;

  $query = "";
  if($location != NULL) $query .= "Location='" . $location . "' AND ";
  if($time != NULL) $query .= "Time='" . $time . "' AND ";
  $query .= "Day='%s' OR Date='%s'";

  $conditions = sprintf($query, $day, $date);

  $result = queryDB($table, $headers, $conditions);

	if ($result->num_rows > 0) {

    $count = 0;
    $
		while($row = $result->fetch_assoc()) {
      if($flag == 'single')  {
        if($row['Type'] == 'Game') $symbol = $GLOBALS['symbols']['spade'];
  			else if($row['Type'] == 'Lesson') $symbol = $GLOBALS['symbols']['heart'];
  			else if($row['Type'] == 'Other') $symbol = $GLOBALS['symbols']['diamond'];
  			else $symbol = $GLOBALS['symbols']['club'];
        printf("%s<a href='../schedule/event.php?post=%s&date=%s'>%s</a>: %s<br><br>", $symbol, $row['ID'], $date, $row['Name'], $row['Description']);
  			//echo $symbol . "<a href='../schedule/event.php?post=" . $row['ID'] . "'>" . $row['Name'] . '</a><br><br>';
      }
      else if($flag == 'calendar' && $count < 2)  {
        $count++;
        if($row['Type'] == 'Game') $symbol = $GLOBALS['symbols']['spade'];
  			else if($row['Type'] == 'Lesson') $symbol = $GLOBALS['symbols']['heart'];
  			else if($row['Type'] == 'Other') $symbol = $GLOBALS['symbols']['diamond'];
  			else $symbol = $GLOBALS['symbols']['club'];
        printf("%s<a href='../schedule/event.php?post=%s&date=%s'>%s</a><br>", $symbol, $row['ID'], $date, $row['Name']);
      }
      else if($count >= 2)  {
        printf("<a href='day.php?day=%s&location=%s'><b>View More</b></a><br>", $date, $location);
      }

		}
	}
}

function doSingleDay($date, $location)  {

  $dateObj = getdate(strtotime($date));
  $day = $dateObj['weekday'];

  printf("<div class='dayHeader'><h3 class='centerText'>%s</h3></div>", getTextDate($date));
  echo "<h1>Events at " . $location . "</h1>";
  $table = "TimeSlots";
  $headers = NULL;
  $conditions = sprintf("Day='%s' AND Location='%s'", $day, $location);
  $result = queryDB($table, $headers, $conditions);

  if ($result->num_rows > 0) {
		// output data of each row
		$times = array();
		while($row = $result->fetch_assoc()) {
			array_push($times, $row['Time']);
		}

		$times = bubbleSort($times);

		foreach($times as $time)  {
			$printTime = convertTime($time);
      echo '<h4>' . $printTime . '</h4>';
			showEvents($date, $day, $location, $time, 'single');
		}
	}
  else echo "0 results";
}


?>
