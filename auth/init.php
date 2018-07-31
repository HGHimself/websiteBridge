<?php

$pathToRoot = '../';
$dirname = basename(dirname(__FILE__)) . '/';

include $pathToRoot . "config.php";
include "functions.php";

if(isset($_POST['login']))  {
  echo 'You have logged in!';
}

?>
