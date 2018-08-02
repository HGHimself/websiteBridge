<?php

$pathToRoot = '../';
$dirname = basename(dirname(__FILE__)) . '/';
$message = "";

include $pathToRoot . "config.php";
include "functions.php";

if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == TRUE)  {
  $_SESSION['loggedIn'] = FALSE;
  $message = "You have logged out";
}

if(isset($_POST['login']))  {
  //echo "Trying to login";
  $table = 'Users';
  $headers = NULL;
  $conditions = sprintf("Username='%s'", $_POST['username']);

  $results = queryDB($table, $headers, $conditions);
  if ($results->num_rows != 1) {
    $message = "Username not in use.";
  }
  else  {

    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (password_verify($_POST['password'], $hash)) {
      // Authenticated.
      if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
          $message = "Error with password encryption. Please notify an administrator.";
      }
      $fullPath = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

      $_SESSION["loggedIn"] = TRUE;
      while($row = $results->fetch_assoc()) {
  			$_SESSION["name"] = $row['Name'];
  		}


      if(substr($fullPath, -14) == "auth/index.php") $path = substr($fullPath, 0, -14);
      else  $path = substr($fullPath, 0, -5);
      header("Location: http://" . $path );
      die();


    }
    else  {
      $message = "Password is incorrect.";
    }
  }
}
else if(isset($_POST['create']))  {

  if($_POST['password'] != $_POST['password_confirm'])  {
    $message = "Passwords do not match, please retry.";
  }
  else  {
    $table = 'Users';
    $headers = NULL;
    $conditions = sprintf("Username='%s'", $_POST['username']);

    $results = queryDB($table, $headers, $conditions);
    if ($results->num_rows > 0) {
      $message = "Username already in use.";
  	}
    else  {

      $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $table = "Users";
      $values = array(
                'Username' => $_POST['username'],
                'Password'  => $hash,
                'Name' => $_POST['name'],
                'Email' => $_POST['email'],
                'Role' => $_POST['role'],
                'CreatedOn' => getToday(),
                'Graveyard' => 0,
              );

      insertIntoTable($table, $values);
      $message = "New user successfully created.";
    }
  }
}
else if(isset($_GET['user']))  {
  $table = 'Users';
  $headers = NULL;
  $conditions = sprintf("ID='%s'", $_GET['user']);

  $results = queryDB($table, $headers, $conditions);
  if ($results->num_rows == 1) {
    while($row = $result->fetch_assoc()) {
			$user_name = $row['Name'];
      $user_username = $row['Username'];
      $user_role = $row['Role'];
      $user_email = $row['Email'];
		}
  }

}

?>
