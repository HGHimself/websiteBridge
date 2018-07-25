<?php

$pathToRoot = '../';
$dirname = basename(dirname(__FILE__)) . '/';

include $pathToRoot . "config.php";
include "functions.php";

$weekdays = $GLOBALS['weekdays'];

if(isset($_GET['function']))  {

	if($_GET['function'] == 'addTime')  {
		$table = "TimeSlots";
		$values = array(
							'Time' => $_GET['time'],
							'Day'  => $_GET['day'],
						);
		insertIntoTable($table, $values);
  }

	else if($_GET['function'] == 'removeTime') removeById("TimeSlots", $_GET['id']);

	else if($_GET['function'] == 'remove') removeById("Events", $_GET['id']);

  if($_GET['function'] == 'getTimes') getTimes($_GET['day']);
	else doDisplay($weekdays);
}

if(isset($_POST['submit']))  {

	$table = "Events";
	$values = array(
						'Name' 			  => $_POST['name'],
						'Description' => $_POST['description'],
						'CreatedOn'		=> getToday(),
						'Type'				=> $_POST['type'],
						'Location'				=> $_POST['location'],
						);

	if(isset($_POST['reoccurring']))  {
		$values['Time'] = $_POST['rTime'];
		$values['Reoccurring'] = '1';
		$values['Day'] = $_POST['day'];
	}
	else  {
		$values['Time'] = $_POST['time'];
		$values['Reoccurring'] = '0';
		$values['Date'] = $_POST['date'];
	}
	insertIntoTable($table, $values);
}
else if(isset($_POST['update']))  {

	$table = "Events";
	$values = array(
						'Name' 			  => $_POST['name'],
						'Description' => $_POST['description'],
						'CreatedOn'		=> getToday(),
						'Type'				=> $_POST['type'],
						'Location'				=> $_POST['location'],
						);

	if(isset($_POST['reoccurring']))  {
		$values['Time'] = $_POST['rTime'];
		$values['Reoccurring'] = '1';
		$values['Day'] = $_POST['day'];
	}
	else  {
		$values['Time'] = $_POST['time'];
		$values['Reoccurring'] = '0';
		$values['Date'] = $_POST['date'];
	}
	$condition = sprintf("ID='%s'", $_POST['id']);
	updateRowsInTable($table, $values, $condition);
}
if(isset($_POST['remove']))  removeById("Events", $_POST['id']);



?>
