<?php
include "config.php";

if(isset($_POST['remove']))  {
  //echo "heya";
  removeById("regulars", $_POST['id']);
}

function printRegulars()  {
  $mysqli = setUpConnection();
  if(!$mysqli)  {
    echo '<br>The connection didnt work!';
  }
  else  {
    $sql = "SELECT * FROM regulars";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      echo "<table id='scheduleTable' class='center'>";
      echo "<tr><th>Player</th><th>Partner</th><th>Direction</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th><th>Sat</th><th>Sun</th><th></th></tr>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
        if($row['direction'] == 'n_s')  $direction = "North/South";
        else $direction = "East/West";
        $id = $row['id'];
        $no = "_";
        $yes = "Yes";
        if($row['mon'] == 1)  $mon = $yes;
        else $mon = $no;
        if($row['tues'] == 1)  $tues = $yes;
        else $tues = $no;
        if($row['wed'] == 1)  $wed = $yes;
        else $wed = $no;
        if($row['thurs'] == 1)  $thurs = $yes;
        else $thurs = $no;
        if($row['fri'] == 1)  $fri = $yes;
        else $fri = $no;
        if($row['sat'] == 1)  $sat = $yes;
        else $sat = $no;
        if($row['sun'] == 1)  $sun = $yes;
        else $sun = $no;
        $form = "<form action='' method='post'><input type='submit' name='remove' value='Remove'><input type='hidden' name='id' value='" . $id . "'></form>";
        $r = "<tr><td>".$row['name']."</td><td>".$row['partner']."</td><td>".$direction."</td><td>".$mon."</td><td>".$tues."</td><td>".$wed."</td><td>".$thurs."</td><td>".$fri."</td><td>".$sat."</td><td>".$sun."</td>";
        $r .= "<td>" . $form . "</td></tr>";
        echo $r;
      }
      echo "</table>";
    }
    else {
        echo "0 results";
    }
  }
}
?>

<?php include "config.php"; ?>
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
			<div class="row">
			  <div class="leftcolumn">
          <div class='card'>
            <h2>Showing Regulars</h2>
            <h3><a href="addRegular.php">Add a Regular</a></h3>
          </div>
          <div class='card'>
            <?php printRegulars(); ?>
          </div>
        </div>
        <?php include $incLocation . "sidebar.php"; ?>
      </div>
    </main>
    <?php include $incLocation . "footer.php"; ?>
  </body>
</html>
