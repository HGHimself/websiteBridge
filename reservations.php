<?php include "config.php";
$dirname = '';
$pathToRoot = '';


if(!isset($_GET['date']))  {
  $day = getdate();
  $date = $day['year'] . "-" . sprintf('%02d', $day['mon']) . "-" . sprintf('%02d', $day['mday']);
}
else  {
  $date = $_GET['date'];
  $day = getdate(strtotime($date));
}
$textDay = $day['weekday'] . ", " . $day['month'] . " " . $day['mday'] . " " . $day['year'];

if(isset($_POST['remove']))  {
  removeById("Reservation", $_POST['id']);
}
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
			<div class='row'>
				<div class='leftcolumn'>
          <div class='card'>
            <h2>Showing Schedule For: <?php echo $textDay; ?></h2>
            <h3><a href="addReservation.php">Make a Reservation</a></h3>
          </div>
          <div class='card'>
            <form class='center' action='' method="get">
              <label>Go To:</label>
  			      <input name='date' type='date' value='<?php echo $date; ?>' required>
              <input type="submit" value="Go">
            </form>
            <div class='row'>
              <?php printScheduleDate($date); ?>
            </div>
          </div>
        </div>
        <?php include $incLocation . "sidebar.php" ?>
      </div>
    </main>
    <?php include $incLocation . "footer.php"; ?>
  </body>
</html>
