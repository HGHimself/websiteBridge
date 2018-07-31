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
						<h3><a href="index.php">View Schedule</a></h3>
					</div>
					<div class='card'>
						<form id='signupform' class='centerText' action='' method='post'>
							<label>Type:</label>
							<select name='type' id='type' >
                <?php
                  $types = $GLOBALS['types'];
                  foreach($types as $type)  {
                    printf("<option value='%s'>%s</option>", $type, $type);
                  }
                ?>
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
                <?php
                  $locations = $GLOBALS['locations'];
                  foreach($locations as $location)  {
                    printf("<option value='%s'>%s</option>", $location, $location);
                  }
                ?>
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
                  <?php
                    $weekdays = $GLOBALS['weekdays'];
                    foreach($weekdays as $weekday)  {
                      printf("<option value='%s'>%s</option>", $weekday, $weekday);
                    }
                  ?>
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
                    document.getElementById("check").checked = true;
                    document.getElementById("checked").style.display = "block"
                    document.getElementById("notchecked").style.display = "none"
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
              <input name='ajax' id='ajax' type='hidden' value=''>
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
