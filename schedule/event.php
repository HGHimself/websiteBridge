<?php include "init.php"; ?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Event</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
  		<div class='row'>
        <div class='leftcolumn'>
  				<div class='card'>
  					<h2>Event Page</h2>
  					<h3><a href="<?php echo $pathToRoot; ?>calendar">View Calendar</a></h3>
  				</div>
          <div class='card'>
            <?php
            if(isset($_GET['post'])) showEvent($pathToRoot);
            else printf("Examine calendar <a href='%scalendar'>here</a> to find a specific event to view.", $pathToRoot);
            ?>
          </div>
  			</div>
        <?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
      </div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
