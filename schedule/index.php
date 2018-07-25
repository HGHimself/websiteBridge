<?php include 'init.php'; ?>

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
				<div class='card'>
					<h2>Schedule</h2>
					<h3><a href='createEvent.php'>Add an Event</a></h3>
					<?php /*
					<p>This page contains the information that makes up the schedule. The first section is the reoccurring, weekly schedule that will populate the
					calendar. To use, first add a time slot for a specific day if one is not already present. This will allow  for users to only select a time that events
					occur on in order to avoid any mistakes with reservations. From there, navigate to the above link to create an event. From there, further directions
					will guide you through the process.</p>
					<p>Below the weekly schedule are the special events. These only occur once and will disappear after the scheduled date. Like the weekly events,
					a special event will also be added into the calendar.</p>
					*/ ?>
				</div>
			</div>
			<br>
			<div class='row calendar' id='schedule'>
      </div>
      <input name='ajax' id='ajax' type='hidden' value=''>
      <script>
        function runAJAX(method, param)  {
          var url = "init.php?"
          if(method == 'addTime')  {
            url += "time=" + document.getElementById(param + "Time").value
            url += '&day=' + param
            url += "&function=" + method
          }
          else if(method == 'removeTime')  {
            url += "id=" + param
            url += "&function=" + method
          }
          else url += "&function=" + 'doDisplay'
          //alert(url)

          loadDoc(url, 'schedule')
        }
        $( document ).ready(function() {
          runAJAX()
        });

        //document.getElementById('year').addEventListener('change', (event) => {
          //runAJAX()
        //})

      </script>
      <div class='row'>
        <div class='card'>
          <h2>Upcoming Special Events</h2>
          <?php
						showSpecialEvents();
          ?>
        </div>
      </div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
