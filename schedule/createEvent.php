<?php include "init.php"; ?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Create Event</title>
    <script>
    </script>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
			<div class='row'>
				<div class='leftcolumn'>
					<div class='card'>
						<h2>Create an Event</h2>
						<h3><a href="schedule.php">View Schedule</a></h3>
					</div>
					<div class='card'>
						<form id='signupform' class='centerText' action='' method='post'>
							<label>Type:</label>
							<select name='type' id='type' >
								<option value='Other'>Other</option>
								<option value='Lesson'>Lesson</option>
								<option value='Game'>Game</option>
							</select>
							<br>
							<br>
							<label>Name of Event:</label>
							<input name='name' type='text' required>
							<br>
							<br>
							<textarea id='textArea' formid='signupform' name='description' placeholder="Write your description here..."></textarea>
							<br>
							<br>
              <label>Location:</label>
							<select name='location' id='location' >
								<option value='Honors'>Honors</option>
								<option value='Aces'>Aces</option>
								<option value='Cavendish'>Cavendish</option>
							</select>
							<br>
							<br>
							<label>Reoccurring:</label>
			        <input type="checkbox" id="check" name="reoccurring" value="1">
              <br>
							<br>
              <div id='checked'>
								<label>Day:</label>
								<select name='day' id='day' >
									<option value='Sunday'>Sunday</option>
									<option value='Monday'>Monday</option>
									<option value='Tuesday'>Tuesday</option>
									<option value='Wednesday'>Wednesday</option>
									<option value='Thursday'>Thursday</option>
									<option value='Friday'>Friday</option>
									<option value='Saturday'>Saturday</option>
								</select>
  							<br>
  							<br>
								<label>Time:</label>
								<select name='rTime' id='times' >
								</select>
								<script>
									function runAJAX()  {
										var day = document.getElementById("day").value
										var url = "init.php?"
										url += "day=" + day
										url += "&function=getTimes"
										loadDoc(url, 'times')
									}
									$( document ).ready(function() {
	                  document.getElementById('checked').style.display = 'none'
										runAJAX()
	                });
	                document.getElementById("check").addEventListener('change', (event) => {
		                if (event.target.checked) {
		                  document.getElementById("checked").style.display = "block"
		                  document.getElementById("notchecked").style.display = "none"
		                }
										else {
		                  document.getElementById("notchecked").style.display = "block"
		                  document.getElementById("checked").style.display = "none"
		                }
	                })
	                document.getElementById("day").addEventListener('change', (event) => {
										runAJAX()
	                })
	              </script>
								<br>
								<br>
              </div>
              <div id='notchecked'>
								<label>Date:</label>
                <input name='date' type='date' >
                <br>
                <br>
								<label>Time:</label>
	              <input name='time' type='time' >
	              <br>
	              <br>
              </div>
							<input name='submit' type='submit'>
						</form>
					</div>
					<div class='card'>
						<h3>Upcoming Special Events</h3>
						<?php showSpecialEvents(); ?>
					</div>
					<div class='card'>
						<h3>Weekly Events</h3>
						<?php showReoccurringEvents(); ?>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
	</body>
</html>
