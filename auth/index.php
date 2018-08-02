<?php include "init.php";

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)  {
  $message = "You have logged out.";
}
//You have entered the logout page, so logout
$_SESSION['loggedIn'] = FALSE;
$_SESSION['name'] = NULL;
$_SESSION['role'] = NULL;


?>
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
						<h2>Login Page</h2>
						<h3><a href="create.php">Create New Profile</a></h3>
					</div>
					<div class='card'>
            <form id='signupform' class='centerText' action='' method='post'>
              <label>Username:</label>
              <input type="text" name="username">
              <br>
              <br>
              <label>Password:</label>
              <input type="password" name="password">
              <br>
              <br>
              <p><?php echo $message; ?></p>
              <input type="submit" value="Login" name='login'>
            </form>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
