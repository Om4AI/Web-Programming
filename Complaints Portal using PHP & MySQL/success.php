<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="comp_style.css">
    <title>Complaints Portal</title>
</head>
<body>
<?php

session_start();
$compid = $_SESSION['compid'];
echo $compid;
$updated = $_SESSION['updated'];

// DB Connection
$servername = "localhost";
$username = "root";
$pass = "Hello@World";

    // Create connection
$conn = new mysqli("$servername", "$username", "$pass", "parcelsdb") or die("unable to connect");

$sql = "SELECT * FROM complaints WHERE compid=$compid";

// Result from Database
$retval = mysqli_query($conn,"$sql");

$num_rows = mysqli_num_rows($retval);

if($num_rows>0){
    $row = mysqli_fetch_assoc($retval);
    $comptype = $row['CompType'];
    $compdesc = $row['CompDesc'];
    $solution = $row['Solution'];
    $compstatus = $row['CompStatus'];
    $custid = $row['Custid'];
}

?>

<!-- HTML Code -->
        <h1>Updated Details Display Portal</h1>
        <form method="post"  enctype="multipart/form-data">
        <div class="container">

            <h2 style="margin-left: 30px;">Complaint Details - </h3>

            
            <p align="center" ><?php if($updated==1)echo "The complaint details updated successfully"."<br>"; ?></p>

            <p align="center" >CompId: <?php echo $compid;?></p>
            <p align="center" >CompType: <?php echo $comptype;?></p>
            <p align="center" >CompDesc: <?php echo $compdesc;?></p>
            <p align="center" >Solution: <?php echo $solution;?></p>
            <p align="center" >CompStatus: <?php echo $compstatus;?></p>
            <p align="center" >CustomerId: <?php echo $custid;?></p>

            
        </div>
              
        </div></form> 

    
</body>
</html>