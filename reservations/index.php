
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Home</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
    <main>
			<div class='row'>
				<div class='leftcolumn'>
					<div class='card'>
						<h2>TestPage</h2>
						<h3><a href="#">Link</a></h3>
					</div>
					<div class='card'>
            <?php
            $year = '2018';
            echo $result = findLeapYear($year);
            if($result === TRUE)  {
              echo 'yeet';
              $monthDays['February'] = 29;
            }

            ?>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
