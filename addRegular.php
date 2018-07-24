<?php
include "config.php";

if(isset($_POST['submit']))  {
	$mysqli = setUpConnection();
	if(!$mysqli)  {
		$message = 'The connection didnt work!';
	}
	else  {

		$sql = "INSERT INTO regulars (name, partner, direction, mon, tues, wed, thurs, fri, sat, sun) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $mysqli->prepare($sql);

    if(!isset($_POST['partner']))  $partner = NULL;
    else $partner = $_POST['partner'];

    if(!isset($_POST['mon']))  $mon = 0;
    else $mon = 1;

    if(!isset($_POST['tues']))  $tues = 0;
    else $tues = 1;

    if(!isset($_POST['wed']))  $wed = 0;
    else $wed = 1;

    if(!isset($_POST['thurs']))  $thurs = 0;
    else $thurs = 1;

    if(!isset($_POST['fri']))  $fri = 0;
    else $fri = 1;

    if(!isset($_POST['sat']))  $sat = 0;
    else $sat = 1;

    if(!isset($_POST['sun']))  $sun = 0;
    else $sun = 1;

		$stmt->bind_param("ssssssssss", $_POST['name'], $partner, $_POST['direction'], $mon, $tues, $wed, $thurs, $fri, $sat, $sun);

		if ($stmt->execute() === TRUE) {
  		$message = "New record created successfully";
		} else {
		  $message = "Error: " . $sql . "<br>" . $mysqli->error;
		}

		$stmt->close();
		$mysqli->close();
	}
}
else  {
  $message = "";
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
						<h2>Sign Up A Regular</h2>
						<h3><a href="regulars.php">View Regulars</a></h3>
					</div>
					<div class='card'>
						<form id='signupform' class='centerText' action='' method='post'>
							<label>Name:</label>
							<input name='name' type='text' required>
							<br>
							<br>
							<label>Preferred Partner:</label>
							<input name='partner' type='text'>
							<br>
							<br>
							<label>Preferred Direction:</label>
							<select name='direction' required>
								<option value='n_s'>North/South</option>
								<option value='e_w'>East/West</option>
							</select>
							<br>
							<br>
							<label>Days of Week to Play:</label>
			        <br>
			        <input type="checkbox" name="mon" value="mon"><label>Monday</label><br>
			        <input type="checkbox" name="tues" value="tues"><label>Tuesday</label><br>
			        <input type="checkbox" name="wed" value="wed"><label>Wednesday</label><br>
			        <input type="checkbox" name="thurs" value="thurs"><label>Thursday</label><br>
			        <input type="checkbox" name="fri" value="fri"><label>Friday</label><br>
			        <input type="checkbox" name="sat" value="sat"><label>Saturday</label><br>
			        <input type="checkbox" name="sun" value="sun"><label>Sunday</label><br>
							<br>
							<br>
			        <?php echo $message . "<br>"; ?>
							<input name='submit' type='submit'>
						</form>
					</div>
				</div>
				<?php include $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $incLocation . "footer.php"; ?>
	</body>
</html>
