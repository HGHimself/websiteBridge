<?php

function fillSelect($locations)  {
  foreach($locations as $name => $link)  {
    if($loc == $name) $selected = "selected='selected'";
    else $selected = '';

    printf("<option %s value='%s'>%s</option>", $selected, $name, $name);
  }
}

function showResults($locations, $location)  {
  $iframeHeight = '900px';
  $iframeWidth = '100%';

  $url = $locations[$location];
  printf("<iframe src='%s' height='%s' width='%s'></iframe>", $url, $iframeHeight, $iframeWidth);

}

?>
