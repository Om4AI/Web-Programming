<!-- Connect to Database -->


<?php
$servername = "localhost";
$username = "root";
$pass = "Hello@World";

// Create connection
$conn = new mysqli("$servername", "$username", "$pass", "parcelsdb") or die("unable to connect");

// Check connection
if ($conn) {
  echo "DB Connected successfully"."<br>";
}

// SELECT VALUES
$sql = "SELECT * FROM `complaints` WHERE CompId=1";
$retval = mysqli_query($conn, $sql);

// Find the number of records
$num_rows = mysqli_num_rows($retval);
echo "<br>";

// Display rows fetched
if($num_rows>0){
  $row = mysqli_fetch_assoc($retval);
  echo $row['CompType']."<br>";
}

mysqli_close($conn);
?>
