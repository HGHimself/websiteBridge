<?php

function fillSelect($locations)  {
  if(isset($_GET['location']))  $location = $_GET['location'];
  else $location = "Honors";
  foreach($locations as $l => $link)  {
    //if the loc is the one from GET, make it selected
    if($l == $location) $selected = "id='location' selected='selected'";
    else $selected = '';
    //add that b
    printf("<option %s value='%s'>%s</option>", $selected, $link, $l);
  }
}


function doLocations()  {
  $locations = $GLOBALS['locations'];

}

function showResults($locations, $location)  {
  $iframeHeight = '900px';
  $iframeWidth = '100%';

  $url = $locations[$location];
  printf("<iframe src='%s' height='%s' width='%s'></iframe>", $url, $iframeHeight, $iframeWidth);

}

?>
