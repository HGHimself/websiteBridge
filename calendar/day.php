<?php include "init.php";
if(isset($_GET['day'])) $day = $_GET['day'];
else $day = "NULL";
?>
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
			  <div class="leftcolumn">
          <div class="row">
            <div class='card'>
              <h2>Single Day View</h2>
              <h3><a href="<?php echo $pathToRoot; ?>calendar">View Full Calendar</a></h3>
            </div>
            <div class='card'>
              <form action='' method='get'>
                <label>Location:</label>
                <select name='location' id='location' onchange='runAJAX()'>
                  <?php doLocations(); ?>
                </select>
                <input name='ajax' id='day' type='hidden' value='<?php echo $day; ?>'>
                <input name='ajax' id='ajax' type='hidden' value=''>
              </form>
            </div>
            <div id='singleDay' class='card center'>
            </div>
            <script>
              function runAJAX()  {
                var location = document.getElementById("location").value
                var date = document.getElementById("day").value
                var url = "init.php?"
                if(date != 'NULL')  {
                  url += "&date=" + date
                }
                url += "&location=" + location
                url += "&function=doSingleDay"
                loadDoc(url, 'singleDay')
              }
              $( document ).ready(function() {
                runAJAX()
              })
              document.getElementById("location").addEventListener('change', (event) => {
                runAJAX()
              })
            </script>
    			</div>
			  </div>
			 	<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
