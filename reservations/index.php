<?php include "init.php"; ?>
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
						<h2>Make Reservations</h2>
						<h3><a href="#">View My Reservations</a></h3>
					</div>
					<div class='card'>
            <form id='signupform' class='centerText' action='' method='post'>
							<label>Your Name:</label>
							<input name='player' type='text' required>
							<br>
							<br>
							<label>Partner's Name:</label>
							<input name='partner' type='text'>
							<br>
							<br>
							<label>Preferred Direction:</label>
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
              <script>
                function runAJAX()  {
                  var day = document.getElementById("date").value
                  var url = "init.php?"
                  url += "date=" + date
                  url += "&function=getTimes"
                  loadDoc(url, 'times')
                }
                $( document ).ready(function() {
                  //runAJAX()
                });

                document.getElementById("date").addEventListener('change', (event) => {
                  runAJAX()
                })
              </script>
							<label>Time:</label>
							<select name='time' id='times' required>
							</select>
							<br>
							<br>
							<label>Game:</label>
							<select name='event' required>
								
							</select>
							<br>
							<br>
							<?php echo $message . "<br>"; ?>
							<input name='submit' type='submit'>
						</form>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
