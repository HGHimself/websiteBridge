<?php

function populateUserData($id)  {

  $table = 'Users';
  $headers = NULL;
  $conditions = sprintf("ID='%s'", $id);

  $results = queryDB($table, $headers, $conditions);
  $user = array();
  if ($results->num_rows == 1) {
    while($row = $results->fetch_assoc()) {
			$user['name'] = $row['Name'];
      $user['username'] = $row['Username'];
      $user['role'] = $row['Role'];
      $user['email'] = $row['Email'];
      $user['id'] = $row['ID'];
		}
  }
  return $user;
}




?>
