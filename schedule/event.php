<?php include "config.php";

function showEvent()  {
  $id = $_GET['post'];

  $tableName = 'Events';
  $headers = NULL;
  $conditions = sprintf('ID=%s', $id);

  $result = queryDB($tableName, $headers, $conditions);

  //print_r($results);
  if ($result->num_rows > 0) {
		// output data of each row

		while($row = $result->fetch_assoc()) {
			printf('<h1>%s</h1>', $row['Name']);
      if($row['Reoccurring'] == '1')  {
        printf('<h3>On %s ', $row['Day']);
      }
      else  {
        $textDay = getTextDate($row['Date']);
        printf('<h3>On %s ', $textDay);
      }
      printf('at %s</h3>', convertTime($row['Time']));

      printf('<p>%s</p>', $row['Description']);

      printf("<a href='addReservation.php?id=%s'>Click Here</a> To Make A Reservation", $row['ID']);

		}
  }


}

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
  		<div class='row'>
        <div class='leftcolumn'>
  				<div class='card'>
  					<h2>Event Page</h2>
  					<h3><a href="schedule.php">View Weekly Schedule</a></h3>
  				</div>
          <div class='card'>
            <?php if(isset($_GET['post']))  {showEvent();}  ?>
          </div>
  			</div>
        <?php include $incLocation . "sidebar.php"; ?>
      </div>
		</main>
		<?php include $incLocation . "footer.php"; ?>
  </body>
</html>
