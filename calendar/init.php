<?php

$pathToRoot = '../';
$dirname = basename(dirname(__FILE__)) . '/';

include $pathToRoot . "config.php";
include "functions.php";

$months = $GLOBALS['months'];
$weekdays = $GLOBALS['weekdays'];
$monthDays = $GLOBALS['monthDays'];



if(isset($_GET['year'])) $year = $_GET['year'];
else $year = getdate()['year'];

if(isset($_GET['month'])) $month = $_GET['month'];
else $month = getdate()['month'];


if(isset($_GET['function']))  {
  if($_GET['function'] == 'doCalendar')  {
    //echo $_GET['month'];
    doCalendar($_GET['month'], $_GET['year'], $_GET['location']);
  }

  if($_GET['function'] == 'doSingleDay')  {
    if(isset($_GET['date'])) doSingleDay($_GET['date'], $_GET['location']);
    else printf("Examine calendar <a href='%scalendar'>here</a> to find a specific day to view.", $pathToRoot);
  }
}

?>
