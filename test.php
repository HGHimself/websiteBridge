<?php
include "config.php";
$pathToRoot = "";
$dirname = "";
?>

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
			<div class="row">
			  <div class="leftcolumn">
			    <div class="card">
					<?php

          $table = "Events";
          $values = array(
              'Type' => 'Game',
              'Location' => 'Cavendish',
          );
          $condition = "WHERE ID='28'";

          updateRowsInTable($table, $values, $condition);
					?>
			    </div>
			  </div>
			 	<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
