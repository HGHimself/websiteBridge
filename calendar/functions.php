<?php

//populates the dropdown from months, makes the month from GET selected
function doMonths($months, $month)  {
  foreach($months as $m)  {
    //if the mon is the one from GET, make it selected
    if($m == $month) $selected = "id='month' selected='selected'";
    else $selected = '';
    //add that b
    printf("<option %s value='%s'>%s</option>", $selected, $m, $m);
  }
}

//will create a calendar given a month and year
function doCalendar($month, $year)  {

	$months = $GLOBALS['months'];
	$weekdays = $GLOBALS['weekdays'];
	$monthDays = $GLOBALS['monthDays'];
  
  if(findLeapYear($year))  {
    echo 'yeet';
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
            printf("<b>%s</b><br>", $count++);
            showEvents($id, $day);
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
   	        printf("<b>%s</b><br>", $count++);
            showEvents($id, $day);
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

function showEvents($date, $day)  {

  //query the db for all reoccurring events at a certain time and day
	$table = "Events";
  $headers = NULL;
  $conditions = sprintf("Day='%s' OR Date='%s'", $day, $date);
  $result = queryDB($table, $headers, $conditions);

	if ($result->num_rows > 0) {
		// output data of each row
		//echo '<ul>';
		while($row = $result->fetch_assoc()) {
			if($row['Type'] == 'Game') $symbol = $GLOBALS['symbols']['spade'];
			else if($row['Type'] == 'Lesson') $symbol = $GLOBALS['symbols']['heart'];
			else if($row['Type'] == 'Other') $symbol = $GLOBALS['symbols']['diamond'];
			else $symbol = $GLOBALS['symbols']['club'];
			echo $symbol . "<a href='event.php?post=" . $row['ID'] . "'>" . $row['Name'] . '</a><br><br>';
		}
		//echo '</ul>';
	}
}

?>
