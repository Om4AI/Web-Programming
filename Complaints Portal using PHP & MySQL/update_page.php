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
        <h1>Update Details Portal</h1>
        <form method="post"  enctype="multipart/form-data">
        <div class="container">

            <h2 style="margin-left: 30px;">Complaint Details - </h3>

            <div class="row">
                <div class="col-10">
                    <label for="name">CompID:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="name" name="name" required maxlength="50" minlength="2" value="<?php echo htmlspecialchars($compid) ?>" readonly="true">
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="mobile">CompType:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="mobile" name="comptype" value="<?php echo htmlspecialchars($comptype); ?>" readonly="true">
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="email">CompDesc:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="email" name="compdesc" value="<?php echo htmlspecialchars($compdesc); ?>" readonly="true">
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="univ">Solution:</label>
                </div>
                <div class="col-90">
                    <textarea name="solution" value="<?php echo htmlspecialchars($solution); ?>" cols="30" rows="10" minlength="50" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="univ">CompStatus:</label>
                </div>
                <div class="col-90">
                    <input type="text" name="compstatus" value="<?php echo htmlspecialchars($compstatus); ?>" required>
                </div>
            </div>


            <div class="row">
                <div class="col-10">
                    <label for="mobile">CustID:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="mobile" name="custid" value="<?php echo htmlspecialchars($custid); ?>" readonly="true">
                </div>
            </div>


            <div class="row">
                <input type="submit" value="Submit" name="Submit">
            </div> 

            <?php
            // Set new values in the database

            $new_sol = $_POST['solution'];
            $new_status = $_POST['compstatus'];
            
            $newsql = "UPDATE complaints SET Solution='".$new_sol."',CompStatus='".$new_status."' WHERE CompId=$compid";
            $updated =0;
            if (mysqli_query($conn, $newsql)){
                $updated = 1;
                echo "Record successfully updated!";
            }else{
                echo "Error updating table!";
            }

            $_SESSION['updated'] = $updated;

            mysqli_close($conn);
            ?>

            
        </div>
              
        </div></form> 

    
</body>
</html>