<?php include "config.php";
$dirname = '';
$pathToRoot = '';
?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $incLocation . "meta.php"; ?>
    <title>Reservation</title>
	</head>
  <body>
		<?php include $incLocation . "header.php"; ?>
		<?php include $incLocation . "nav.php"; ?>
      <main>
        <?
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)  {
          printf("<h2>Welcome %s!</h2>", $_SESSION['name']);
        }
        ?>
  			<div class="row">
  			  <div class="leftcolumn">
  			    <div class="card">
              <h2>About Us</h2>
              <p>Honors is Manhattan's premier bridge club. It was founded in 1993 by Gail Greenberg and for the second year in a row is the largest bridge club in the country by far. To put our size in perspective, Honors offers more games just for the developing player, than 95% of the other bridge clubs in the country have games.</p>
              <p>Our entry level Beginner 1 course is unique. We have probably created more bridge players than anyone else in the country. </p>
  			    </div>
  					<div class="card">
              <h2>Honors Co-Presidents:</h2>
              <ul>
                <li>Scott Levine</li>
                <li>Jeff Bayone, Managing Partner</li>
              </ul>
  			    </div>
  					<div class="card">
              <h2>Honors Teaching Faculty:</h2>
              <ul>
                <li>Sam Amer	Zeus Arias	Barbara Bayone	Giorgia Botta</li>
                <li>Joseph Byrnes	Jacqueline Chang	Alene Friedman	Ellen Friedman</li>
                <li>Bonnie Gellas	Gail Greenberg	Andrea Hayman	Jeff Hearn</li>
                <li>Jess Jurkovic	Sherry Ann Kavaler	Sam Kuang Irina Levitina </li>
                <li>David Libchaber	Marin Marinov	Jacqui Mitchell	Tom Ng</li>
                <li>Yefim Shoykhet Ellen Waldman David Yoon</li>
              </ul>
  			    </div>
  			    <div class="card">
              <h2>Game Directors:</h2>
              <ul>
                <li>Head director: Aviv Shahaf</li>
                <li>Barbara Bayone</li>
                <li>Giorgia Botta</li>
                <li>Stephannie Culbertson</li>
                <li>Bonnie Gellas</li>
                <li>Elliott Grubman</li>
                <li>Jeff Hearn</li>
                <li>Kerry Kappel</li>
                <li>Paul Kirby</li>
                <li>David Libchaber</li>
                <li>Marin Marinov</li>
                <li>Christopher Rivera</li>
                <li>Yefim Shoykhet</li>
                <li>Yoko Sobel</li>
                <li>James Southern</li>
              </ul>
  			    </div>
            <div class="card">
              <h2>VISIT OUR FRIENDS:</h2>
              <h3>
                <?php echo $GLOBALS['symbols']['spade']; ?>
                <a href='www.hartesclub.com'>Hartes' Bridge Club</a>
                <?php echo $GLOBALS['symbols']['heart']; ?>
                <a href='www.gnyba.org'>Greater New York Bridge Association</a>
                <?php echo $GLOBALS['symbols']['diamond']; ?>
                <a href='www.acbl.org'>American Contract Bridge League</a>
                <?php echo $GLOBALS['symbols']['heart']; ?>
              </h3>
              </ul>
  			    </div>
  			  </div>
  			 	<?php include $incLocation . "sidebar.php"; ?>
  			</div>
  		</main>
<?php include $incLocation . "footer.php"; ?>
</body>
</html>
