<?php
include "config.php";

?>

<!DOCTYPE html>
<html>
  <head>
		<?php include $incLocation . "meta.php"; ?>
    <title>Home</title>
	</head>
  <body>
		<?php include $incLocation . "header.php"; ?>
		<?php include $incLocation . "nav.php"; ?>
		<main>
			<div class="row">
			  <div class="leftcolumn">
			    <div class="card">
					<?php


        	$year = 2018;
          printf("<h1>%s:%s</h1>", findLeapYear($year), $year);
					?>
			    </div>
			  </div>
			 	<?php include $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $incLocation . "footer.php"; ?>
  </body>
</html>
