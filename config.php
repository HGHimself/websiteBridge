<?php

$incLocation = "inc/";
$toolsLocation = "tools/";


include $toolsLocation . "connection.php";

global $locations;
$locations = array(
          'Honors',
          'Aces',
          'Cavendish',
          );

global $types;
$types = array(
          'Game',
          'Lesson',
          'Other',
          );

global $symbols;
$symbols['spade'] = "<b class='blackSuit'>♠</b>";
$symbols['heart'] = "<b class='redSuit'>♥</b>";
$symbols['diamond'] = "<b class='redSuit'>♦</b>";
$symbols['club'] = "<b class='blackSuit'>♣</b>";

$symbols['l_spade'] = "<b class='blackSuit'>♤</b>";
$symbols['l_heart'] = "<b class='redSuit'>♡</b>";
$symbols['l_diamond'] = "<b class='redSuit'>♢</b>";
$symbols['l_club'] = "<b class='blackSuit'>♧</b>";

$day = getdate();
$year = $day['year'];


global $months;
$months = array(
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
        );

global $monthDays;
$monthDays = array(
          'January' => '31',
          'February' => '28',
          'March' => '31',
          'April' => '30',
          'May' => '31',
          'June' => '30',
          'July' => '31',
          'August' => '31',
          'September' => '30',
          'October' => '31',
          'November' => '30',
          'December' => '31',
          );

global $weekdays;
$weekdays = array(
          'Sunday',
          'Monday',
          'Tuesday',
          'Wednesday',
          'Thursday',
          'Friday',
          'Saturday'
          );


?>
