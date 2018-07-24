<?php

$pathToRoot = '../';
$dirname = basename(dirname(__FILE__)) . '/';

include $pathToRoot . "config.php";

$locations = array(
    'Honors' => 'http://clubresults.acbl.org/results.php?id=MjMyMTMy',
    'Aces' => 'http://clubresults.acbl.org/results.php?id=MjcwMzYz',
    'Cavendish' => 'http://clubresults.acbl.org/results.php?id=MjI3MzA2',
);

if(isset($_GET['location'])) $loc = $_GET['location'];
else $loc = "";

include 'functions.php';

if(isset($_GET['function']))  {
  if($_GET['function'] == 'showResults')  {
    showResults($locations, $_GET['loc']);
  }
}

?>
