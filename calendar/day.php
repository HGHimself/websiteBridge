<?php include "init.php"; ?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Calendar</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
      <div class="row">
			  <div class="leftcolumn">
          <div class="row">
            <div class='card'>
              <h2>Single Day View</h2>
              <h3><a href="<?php echo $pathToRoot; ?>calendar">View Full Calendar</a></h3>
            </div>
            <div class='card center'>
              <?php
              if(isset($_GET['day'])) doSingleDay($_GET['day']);
              else printf("Examine calendar <a href='%scalendar'>here</a> to find a specific day to view.", $pathToRoot);
              ?>
            </div>
    			</div>
			  </div>
			 	<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
