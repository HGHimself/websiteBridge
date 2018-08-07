<?php include "config.php";
$dirname = '';
$pathToRoot = '';
?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $incLocation . "meta.php"; ?>
    <title>Home</title>
	</head>
  <body>
		<?php include $incLocation . "header.php"; ?>
		<?php include $incLocation . "nav.php"; ?>
		<main>
      <?
      if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)  {
        printf("<h2 class='dayHeader'>Welcome %s!</h2>", $_SESSION['name']);
      }
      ?>
			<div class="row">
			  <div class="leftcolumn">
			    <div class="card">
			      <h2>TITLE HEADING</h2>
			      <h5>Title description, Dec 7, 2017</h5>
			      <div class="fakeimg" style="height:200px;">Image</div>
			      <p>Some text..</p>
			      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
			    </div>
					<div class="card">
			      <h2>Post of the day</h2>
			      <h5>Title description, Dec 7, 2017</h5>
			      <div class="fakeimg" style="height:200px;">Image</div>
			      <p>Some text..</p>
            <p>Put whatever in here...</p>
			    </div>
					<div class="card">
			      <h2>TITLE HEADING</h2>
			      <h5>Title description, Dec 7, 2017</h5>
			      <div class="fakeimg" style="height:200px;">Words pictures anything</div>
			      <p>Some text..</p>
			      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
			    </div>
			    <div class="card">
			      <h2>TITLE HEADING</h2>
			      <h5>Title description, Sep 2, 2017</h5>
			      <div class="fakeimg" style="height:200px;">Image</div>
			      <p>Some text..</p>
			      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
			    </div>
			  </div>
			 	<?php include $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $incLocation . "footer.php"; ?>
  </body>
</html>
