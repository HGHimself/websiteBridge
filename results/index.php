<?php include "init.php"; ?>

<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>Game Results</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
		<main>
			<div class='row'>
				<div class='leftcolumn'>
					<div class='card'>
						<h2>View Game Results</h2>
						<h3><a href="<?php echo $pathToRoot; ?>schedule">View Schedule</a></h3>
					</div>
					<div class='card'>
            <form method='get' action=''>
              <label>Location:</label>
              <select name='location' id='loc' >
                <?php fillSelect($locations); ?>
              </select>
              <input name='ajax' id='ajax' type='hidden' value=''>
            </form>
					</div>
          <div class='card' id='results'>
					</div>
          <script>
            function runAJAX()  {
              var loc = document.getElementById("loc").value
              var url = "init.php?"
              url += "loc=" + loc
              url += "&function=showResults"
              loadDoc(url, 'results')
            }
            $( document ).ready(function() {
              runAJAX()
              //document.getElementById("results").innerHTML = "Please select a location to view Game Results from."
            });
            document.getElementById("loc").addEventListener('change', (event) => {
              runAJAX()
            })
          </script>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
	</body>
</html>
