<?php include "config.php";
$dirname = '';
$pathToRoot = '';


	if(isset($_POST['submit']))  {
		$mysqli = setUpConnection();
		if(!$mysqli)  {
			$message = 'The connection didnt work!';
		}
		else  {

			$sql = "INSERT INTO Reservation (Player, Partner, Direction, Date, Time, Event) VALUES(?, ?, ?, ?, ?, ?)";

			$stmt = $mysqli->prepare($sql);

			$stmt->bind_param("ssssss", $_POST['player'], $_POST['partner'], $_POST['direction'], $_POST['date'], $_POST['time'], $_POST['event']);
			print_r($stmt);
			if ($stmt->execute() === TRUE) {
    		$message = "New record created successfully";
			} else {
			  $message = "Error: " . $sql . "<br>" . $mysqli->error;
			}

			$stmt->close();
			$mysqli->close();
		}
	}
	else $message = "";

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
						<h2>Sign Up For Bridge</h2>
						<h3><a href="reservations.php">View Reservations</a></h3>
					</div>
					<div class='card'>
						<form id='signupform' class='centerText' action='' method='post'>
							<label>Your Name:</label>
							<input name='player' type='text' required>
							<br>
							<br>
							<label>Partner's Name:</label>
							<input name='partner' type='text' required>
							<br>
							<br>
							<label>Direction:</label>
							<select name='direction' required>
								<option value='N/S'>North/South</option>
								<option value='E/W'>East/West</option>
							</select>
							<br>
							<br>
							<label>Date:</label>
							<input name='date' type='date' required>
							<br>
							<br>
							<label>Time:</label>
							<select name='time' required>
								<option value='9:00am'>9:00am</option>
								<option value='9:15am'>9:15am</option>
								<option value='9:30am'>9:30am</option>
								<option value='12:45pm'>12:45pm</option>
								<option value='1:00pm'>1:00pm</option>
								<option value='6:30pm'>6:30pm</option>
								<option value='6:45pm'>6:45pm</option>
							</select>
							<br>
							<br>
							<label>Game:</label>
							<select name='event' required>
								<option value='Handicap'>Handicap(White)</option>
								<option value='Open'>Open(Yellow/Green)</option>
								<option value='0-20'>0-20(Nuplicate)</option>
								<option value='0-99'>0-99(Novice)</option>
								<option value='0-750'>0-750(Intermediate)</option>
							</select>
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
