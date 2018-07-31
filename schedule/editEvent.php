<?php include "init.php"; ?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Edit Event</title>
    <?php
      if(isset($_GET['id'])) {
        $row = getEvent($_GET['id']);
        $flag = 0;
      }
      else $flag = 1;

      //print_r($row);
    ?>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
			<div class='row'>
				<div class='leftcolumn'>
					<div class='card'>
						<h2>Edit an Event</h2>
						<h3><a href="index.php">View Schedule</a></h3>
					</div>
					<div class='card'>
            <?php if($flag == 0): ?>
						<form id='signupform' class='centerText' action='' method='post'>
							<label>Type:</label>
							<select name='type' id='type' >
              <?php
                $types = $GLOBALS['types'];
                foreach($types as $type)  {
                  if($type == $row['Type']) $selected = 'selected';
                  else $selected = '';
                  printf("<option %s value='%s'>%s</option>", $selected, $type, $type);
                }
              ?>
							</select>
							<br>
							<br>
							<label>Name of Event:</label>
							<input name='name' type='text' value='<?php echo $row['Name']; ?>' required>
							<br>
							<br>
							<textarea id='textArea' formid='signupform' name='description' placeholder="Write your description here..."><?php echo $row['Description']; ?></textarea>
							<br>
							<br>
              <label>Location:</label>
							<select name='location' id='location' >
              <?php
                $locations = $GLOBALS['locations'];
                foreach($locations as $location)  {
                  if($location == $row['Location']) $selected = 'selected';
                  else $selected = '';
                  printf("<option %s value='%s'>%s</option>", $selected, $location, $location);
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
                      if($weekday == $row['Day']) $selected = 'selected';
                      else $selected = '';
                      printf("<option %s value='%s'>%s</option>", $selected, $weekday, $weekday);
                    }
                  ?>
								</select>
  							<br>
  							<br>
								<label>Time:</label>
								<select name='rTime' id='times' >
								</select>
                <input name='ajax' id='ajax' type='hidden' value=''>
								<script>
									function runAJAX()  {
										var day = document.getElementById("day").value
										var url = "init.php?"
										url += "day=" + day
										url += "&function=getTimes"
										loadDoc(url, 'times')
									}
									$( document ).ready(function() {
										runAJAX()

                    <?php if($row['Reoccurring'] == 1): ?>
                      document.getElementById("check").checked = true;
                      document.getElementById("checked").style.display = "block"
                      document.getElementById("notchecked").style.display = "none"
                    <?php else: ?>
                      document.getElementById("check").checked = false;
                      document.getElementById("notchecked").style.display = "block"
                      document.getElementById("checked").style.display = "none"
                    <?php endif; ?>


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
                  // Listen for the event.
                  document.getElementById('ajax').addEventListener('ajaxEvent', function (e) {
                    var len = document.getElementById("times").options.length
                    var i
                    for(i = 0; i<len; i++)  {
                      console.log(i)
                      if(document.getElementById("times").options[i].text == '<?php echo convertTime($row['Time']); ?>')  {
                        document.getElementById("times").options[i].selected = true
                      }
                    }
                  }, false);
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

              <input name='id' type='hidden' value='<?php echo $row['ID']; ?>'>
							<input name='update' type='submit'>
						</form>
          <?php
            else: printf("Select an Event to edit <a href='%calendar'>here</a>", $pathToRoot);
            endif;
          ?>
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
