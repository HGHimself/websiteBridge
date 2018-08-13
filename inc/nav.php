<div class="topnav">
  <nav>
    <?php
    if(isset($_SESSION['loggedIn']) && $_SESSION["loggedIn"] == TRUE)  $login = "Logout of " . $_SESSION['name'];
    else $login = "Login";

    $links = array(
            "" => "Home",
            "reservations/" => "Reservations",
            "calendar/" => "Calendar",
            "results/" => "Game Results",
            "auth/" => $login,
            "schedule/" => "Schedule",
            "regulars.php" => "Regulars",
    );

    $dropdowns = array(
      "Home" => array(
        "about.php" => "About",
        "#contact" => "Contact",
      ),
      $login => array(
        "auth/update.php" => "View Profile",
        "auth/create.php" => "Create User",
      ),
      "Calendar" => array(
        "calendar/?location=Honors" => "Honors",
        "calendar/?location=Aces" => "Aces",
        "calendar/?location=Cavendish" => "Cavendish",
      ),
      "Game Results" => array(
        "results/?location=Honors" => "Honors",
        "results/?location=Aces" => "Aces",
        "results/?location=Cavendish" => "Cavendish",
      ),
      "Reservations" => array(
        "#-" => "Current Reservations",
        "#" => "Make Reservation",
      ),
    );

    $rightOfNav = array($login, 'Schedule', 'Regulars');

    foreach ($links as $file => $name)  {
      if($dirname == $file) $active = "active";
      else $active = '';

      if(in_array($name, $rightOfNav)) $float = 'right';
      else $float = 'left';
      if(isset($dropdowns[$name]))  {

        printf("<div class='%s dropdown'><a class='%s navLink dropbtn' href='%s'>%s</a>", $float, $active, $pathToRoot . $file, $name);
        printf("<div class='dropdown-content'>");
        foreach($dropdowns[$name] as $dFile => $dName)  {
          printf("<a href='%s'>%s</a>", $pathToRoot . $dFile, $dName);
        }
        echo "</div></div>";
      }
      else printf("<a class='%s %s navLink' href='%s'>%s</a>", $active, $float, $pathToRoot . $file, $name);
    }
    ?>

  </nav>
</div>
