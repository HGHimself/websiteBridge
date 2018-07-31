<?php include "init.php"; ?>

<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Calendar</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
			<div class="row">
        <div class='card'>
          <h2>Calendar</h2>
          <h3><a href="<?php echo $pathToRoot; ?>schedule/">View Weekly Schedule</a></h3>
        </div>
			</div>
      <div class="row">
        <div class='card'>
          <form action='' method='get'>
            <label>Year:</label>
            <input type='number' id='year' name='year' value='<? echo $year; ?>'>

            <select name='month' id='monthSelect' onchange='runAJAX()'>
              <?php doMonths(); ?>
            </select>
            
            <select name='location' id='locationSelect' onchange='runAJAX()'>
              <?php doLocations(); ?>
            </select>
            <input name='ajax' id='ajax' type='hidden' value=''>
          </form>
        </div>
        <br>
			</div>
      <div id='calendar'>
      </div>
      <script>
        function runAJAX()  {
          var year = document.getElementById("year").value
          var month = document.getElementById("monthSelect").value
          var location = document.getElementById("locationSelect").value
          var url = "init.php?"
          url += "year=" + year
          url += "&month=" + month
          url += "&location=" + location
          url += "&function=doCalendar"
          loadDoc(url, 'calendar')
        }
        $( document ).ready(function() {
          runAJAX()
        });

        document.getElementById("year").addEventListener('change', (event) => {
          runAJAX()
        })

      </script>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
