<div class="topnav">
  <nav>
    <?php
    if(isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"] == TRUE)  $login = "Logout-" . $_SESSION['name'];
    else $login = "Login";

    $links = array(
            "" => "Home",
            "reservations.php" => "Reservation",
            "calendar/" => "Calendar",
            "results/" => "Game Results",
            "auth/" => $login,
            "schedule/" => "Schedule",
            "regulars.php" => "Regulars",
    );

    $dropdowns = array(
      "Home" => array(
        "" => "Home",
        "about.php" => "About",
        "#contact" => "Contact",
      ),
      $login => array(
        "auth/" => $login,
        "auth/create.php" => "View Profile",
        "auth/create.php" => "Create User",
      ),
    );

    $rightOfNav = array($login, 'Schedule', 'Regulars');

    foreach ($links as $file => $name)  {
      if($dirname == $file) $active = "active";
      else $active = '';

      if(in_array($name, $rightOfNav)) $right = 'style="float:right"';
      else $right = '';
      if(isset($dropdowns[$name]))  {

        printf("<div class='dropdown'><a %s class='%s navLink dropbtn' href='%s'>%s</a>", $right, $active, $pathToRoot . $file, $name);
        printf("<div class='dropdown-content'>");
        foreach($dropdowns[$name] as $dFile => $dName)  {
          printf("<a href='%s'>%s</a>", $dFile, $dName);
        }
        echo "</div></div>";
      }
      else printf("<a %s %s class='navLink' href='%s'>%s</a>", $right, $active, $pathToRoot . $file, $name);
    }
    ?>

  </nav>
</div>
