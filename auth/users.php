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
						<h2>Create New User</h2>
						<h3><a href="index.php">Login</a></h3>
					</div>
					<div class='card'>
            <form id='signupform' class='centerText' action='' method='post'>
              <label>Username:</label>
              <input required type="text" name="username">
              <br>
              <br>
              <label>Password:</label>
              <input required type="password" name="password">
              <br>
              <br>
              <label>Confirm Password:</label>
              <input required type="password" name="password_confirm">
              <br>
              <br>
              <label>Name:</label>
              <input required type="text" name="name">
              <br>
              <br>
              <label>Email:</label>
              <input type="text" name="email">
              <br>
              <br>
              <label>Role:</label>
              <select name='role' required>
								<?php
                  $roles = $GLOBALS['roles'];
                  foreach($roles as $role)  {
                    printf("<option val='%s'>%s</option>", $role, $role);
                  }
                ?>
							</select>
              <br>
              <br>
              <p><?php echo $message; ?></p>
              <input type="submit" value="Create User" name='create'>
            </form>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
