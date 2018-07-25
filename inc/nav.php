<div class="topnav">
  <nav>
    <?php
    $links = array(
            "index.php" => "Home",
            "reservations.php" => "Reservation",
            "calendar/" => "Calendar",
            "results/" => "Game Results",
            "schedule/" => "Schedule",
            "regulars.php" => "Regulars",
    );

    $rightOfNav = array('Schedule', 'Regulars');

    foreach ($links as $file => $name)  {
      if($dirname == $file) $active = "class='active'";
      else $active = '';

      if(in_array($name, $rightOfNav)) $right = 'style="float:right"';
      else $right = '';

      printf("<a %s %s class='navLink' href='%s'>%s</a>", $right, $active, $pathToRoot . $file, $name);
    }


    ?>

  </nav>
</div>
