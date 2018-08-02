<?php include "init.php";
$flag = 0;
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)  {
  if(isset($_GET['user'])) $id = $_GET['user'];
  else $id = $_SESSION['id'];
  $flag = 0;
  $user = populateUserData($id);
}
else  {
  $flag = 1;
  $message = "You need to log in to edit a profile.";
}

?>
<!DOCTYPE html>
<html>
  <head>
		<?php include $pathToRoot . $incLocation . "meta.php"; ?>
    <title>View User Profile</title>
	</head>
  <body>
		<?php include $pathToRoot . $incLocation . "header.php"; ?>
		<?php include $pathToRoot . $incLocation . "nav.php"; ?>
    <main>
			<div class='row'>
				<div class='leftcolumn'>
					<div class='card'>
						<h2>Update User</h2>
						<h3><a href="index.php"><? echo $login; ?></a></h3>
					</div>
					<div class='card'>
            <?php if($flag == 0):  ?>
            <form id='signupform' class='centerText' action='' method='post'>
              <label>Username:</label>
              <input required type="text" name="username" value='<?php echo $user['username']; ?>'>
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
              <input required type="text" name="name" value='<?php echo $user['name']; ?>'>
              <br>
              <br>
              <label>Email:</label>
              <input type="text" name="email" value='<?php echo $user['email']; ?>'>
              <br>
              <br>
              <label>Role:</label>
              <select name='role' required>
								<?php
                  $selected = '';
                  $roles = $GLOBALS['roles'];
                  foreach($roles as $role)  {
                    if($role == $user['role']) $selected = 'selected';
                    else $selected = '';
                    printf("<option %s val='%s'>%s</option>", $selected, $role, $role);
                  }
                ?>
							</select>
              <input type='hidden' name='user' value='user'>
              <input type='hidden' name='id' value='<? echo $user['id']; ?>'>
              <br>
              <br>
              <p><?php echo $message; ?></p>
              <input type="submit" value="Update User" name='update'>
            <?
            else: echo $message;
            endif;
            ?>
            </form>
					</div>
				</div>
				<?php include $pathToRoot . $incLocation . "sidebar.php"; ?>
			</div>
		</main>
		<?php include $pathToRoot . $incLocation . "footer.php"; ?>
  </body>
</html>
