<?php


//this function here will return the value between the end of $find and beginning of $to
//contained in $string
function stringFind_To($string, $find, $to)  {
	$pos = strpos($string, $find);
	if ($pos === false) {
		return NULL;
	}
	else {
		//$val is the position of the end of the search string $find
		$val = $pos + strlen($find);

		if($to != NULL)  {
			//find position of $to in $string starting at pos of $val
			$result = strpos($string, $to, $val);

			$distance = $result - $val;
			//grab string from $string, starting at $val and traverses to $result
			$answer = substr($string, $val, $distance);
		}
		//else there was no $to, read to end of string
		else  {
			$answer = substr($string, $val);
		}
		return $answer;
	}
}

//this function converts from military time to ~12:30AM~
function convertTime($time)  {
	$printTime = $time;
	$hours = substr($time, 0, 2);
	if((int)$hours > 12) $printTime = ($hours - 12) . substr($time, 2) . "PM";
	else if((int)$hours == 0) $printTime = '12' . substr($time, 2) . "AM";
	else $printTime .= "AM";

	return $printTime;
}

//obviously a bubble sort
function bubbleSort($numbers)  {
	$array_size = count($numbers);

	for ( $i = 0; $i < $array_size; $i++ )
	   for ($j = 0; $j < $array_size; $j++ )  {
		 	$x = substr($numbers[$i], 0, 2) . substr($numbers[$i], 3, 1);
			$y = substr($numbers[$j], 0, 2) . substr($numbers[$j], 3, 1);
	      if ( (int)$x < (int)$y)
	      {
	         $temp = $numbers[$i];
	         $numbers[$i] = $numbers[$j];
	         $numbers[$j] = $temp;
	      }
		}
	return $numbers;
}

function refValues($arr)  {
	if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
	{
    $refs = array();
    foreach($arr as $key => $value)  $refs[$key] = &$arr[$key];
    return $refs;
	}
	return $arr;
}

function getTextDate($date)  {
	$day = getdate(strtotime($date));
	return $textDate = $day['weekday'] . ", " . $day['month'] . " " . $day['mday'] . " " . $day['year'];
}

function getToday()  {
	$day = getdate();
	return makeDate($day['year'], sprintf('%02d', $day['mon']), sprintf('%02d', $day['mday']));
	//return makeDate('2018', '08', '02');
}

function getThisMonth()  {
	return getdate()['month'];
}

function makeDate($year, $month, $day)  {
	return sprintf("%s-%s-%s", $year, $month, $day);
}

function findLeapYear($year)  {
	if($year % 4 == 0)
		if($year % 100 == 0)
			if($year % 400 == 0) return 'TRUE';
			else return 'FALSE';
		else return 'TRUE';
	else return 'FALSE';
}


?>
