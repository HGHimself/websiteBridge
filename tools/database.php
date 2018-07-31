<?php

include "utils.php";

function setUpConnection()  {
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'bridge';

	return new mysqli($host, $user, $password, $database);
}

function removeById($tableName, $id)  {
  $mysqli = setUpConnection();
  if(!$mysqli)  $message = 'The connection didnt work!';
  else  {
    $sql = "DELETE FROM ". $tableName ." WHERE ID=" . $id;

    if ($mysqli->query($sql) === TRUE)  $message = "Record deleted successfully";
    else  $message = "Error deleting record: " . $mysqli->error;

    $mysqli->close();
  }
}

function showSpecialEvents()  {
	$table = 'Events';
	$headers = array('Name', 'Time', 'Date');
	$conditions = "Reoccurring = '0'";

	$results = queryDB($table, NULL, $conditions);

	$tableAttributes = "id='scheduleTable' class='center'";
	makeTableFromResult($results, $headers, $tableAttributes, TRUE);
}


//makes a query to the database in the style of
//'SELECT $headers FROM $table WHERE $conditions'
//
//use $headers = NULL for 'SELECT *'
//do not include 'WHERE' in $conditions
//
//returns $results from query or NULL if something went wrong
function queryDB($table, $headers, $conditions)  {

  $mysqli = setUpConnection();
  if(!$mysqli)  {
    echo '<br>The connection didnt work!';
  }
  else  {
		//start sql
    $sql = "SELECT ";
    $i = 0;
    //add specified column names to query
    if($headers != NULL)
      foreach($headers as $head)  {
        if($i == 0) $sql .= $head;
        else $sql .= sprintf(", %s", $head);
        $i++;
      }
		//or just ALL
    else $sql .= "*";
    //add the table to query
    $sql .= sprintf(" FROM %s", $table);
    //add the conditions 'WHERE ....'
    if($conditions != NULL)  $sql .= " WHERE " . $conditions;
    $sql . "<br>";
    return $mysqli->query($sql);
  }

  return NULL;
}

function makeTableFromResult($result, $headers, $tableAttributes, $withRemove)  {
  //var_dump($result);
  if ($result->num_rows > 0) {
    //begin table
    if($tableAttributes != NULL) echo sprintf("<table %s><tr>", $tableAttributes);
		else echo "<table><tr>";
    $j = 0;
    $stack = array();
    //add headers to table, keep track of which indexes are added
    while($fieldInfo = mysqli_fetch_field($result))  {
      if (in_array($fieldInfo->name, $headers))  {
        array_push($stack, $j);
        echo "<th>" . $fieldInfo->name . "</th>";
      }
      $j++;
    }
    if($withRemove)  echo "<th></th>";
    echo "</tr>";
    //
    //add fields if the index is present in stack
    while($row = $result->fetch_array(MYSQLI_NUM))  {
      $k = 0;
      echo "<tr>";
      foreach($row as $value)  {
        if(in_array($k, $stack))  echo "<td>" . $value . "</td>";
        $k++;
      }
			//include a button to remove the row by id
      if($withRemove)  {
        echo "<td><form action='' method='post'>";
          echo "<input type='submit' name='remove' value='Remove'>";
          echo "<input type='hidden' name='id' value='" . $row[0] . "'>";
        echo "</form></td>";
      }
			echo "</tr>";
    }
    //close table
    echo "</table>";
  }
  else echo "0 results";
}

function insertIntoTable($table, $values)  {
  $mysqli = setUpConnection();
	if(!$mysqli)  {
		echo 'The connection didnt work!';
	}
	else  {
		//begin (col1, col2, ...)
		//and VALUES(data1, data2, ...)
    $headers = "(";
    $data = " VALUES(";

		//create parameters array
		//$types holds specifiers for bind_params i.e. 'sss' for 3 strings
    $params = array('');
    $types = "";

    $i = 0;
		$sql = sprintf("INSERT INTO %s ", $table);
    foreach ($values as $header => $value)  {
      if($i == 0) {
        $headers .= $header;
        $data .= '?';
      }
      else {
        $headers .= sprintf(", %s", $header);
        $data .= ", ?";
      }
			//$headers = '(col1, col2, ...'
			//$data = 'VALUES(?, ?, ...'
			//$params = array( '' , 'data1', 'data2', ...)
			//$types = 'ss...'
      array_push($params, $value);
      $types .= "s";
      $i++;
    }
		//put end parens on
    $headers .= ")";
    $data .= ")";
		//slip $types into $params
		//$params = array( 'ss...' , 'data1', 'data2', ...)
    $params[0] = $types;
    $sql .= $headers . $data;
    //print_r($params);
		//$sql = "INSERT INTO $tableName(col1, col2, ...) VALUES(?, ?, ...)"
		$stmt = $mysqli->prepare($sql);
		//runs $stmt->bind_param() over $params array to allow for dynamic number of cols
    call_user_func_array(array($stmt, 'bind_param'), refValues($params));

		if ($stmt->execute() === TRUE) {
  		//echo "<script>alert(New record created successfully)</script>";
		} else {
		  echo "Error: " . $sql . "<br>" . $mysqli->error;
		}

		$stmt->close();
		$mysqli->close();
	}
}

function updateRowsInTable($table, $values, $condition)  {
  $mysqli = setUpConnection();
	if(!$mysqli)  {
		echo 'The connection didnt work!';
	}
	else  {
		//begin SET ...
    $data = " SET ";

		//create parameters array
		//$types holds specifiers for bind_params i.e. 'sss' for 3 strings
    $params = array('');
    $types = "";

    $i = 0;
		$sql = sprintf("UPDATE %s ", $table);
    foreach ($values as $header => $value)  {
      if($i == 0) $data .= $header .' = ?';
      else $data .= sprintf(", %s = ?", $header);

			//$data = 'SET column1 = value1, column2 = value2, ...'
			//$params = array( '' , 'data1', 'data2', ...)
			//$types = 'ss...'
      array_push($params, $value);
      $types .= "s";
      $i++;
    }

		//slip $types into $params
		//$params = array( 'ss...' , 'data1', 'data2', ...)
    $params[0] = $types;
    $sql .= $data;
		if($condition != NULL) $sql .= " WHERE " . $condition;

		//echo $sql;
    //print_r($params);
		
		//$sql = "INSERT INTO $tableName(col1, col2, ...) VALUES(?, ?, ...)"
		$stmt = $mysqli->prepare($sql);
		//runs $stmt->bind_param() over $params array to allow for dynamic number of cols
    call_user_func_array(array($stmt, 'bind_param'), refValues($params));

		if ($stmt->execute() === TRUE) {
  		//echo "<script>alert(New record created successfully)</script>";
		} else {
		  echo "Error: " . $sql . "<br>" . $mysqli->error;
		}

		$stmt->close();
		$mysqli->close();
	}
}



?>
