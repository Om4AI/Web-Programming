<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <title>Complaints Portal</title>
        <link rel="stylesheet" href="comp_style.css">
    </head>
       
    <body>
        <?php
        session_start();
        $compid = $_POST["compid"];

        $_SESSION['compid'] = $compid;
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
            $compstatus = $row['CompStatus'];
        }

        mysqli_close($conn);
        ?>


    <!-- HTML Code -->
        <h1>Customer Support - Complaints Portal</h1>
        <form method="post" enctype="multipart/form-data">
        <div class="container">

            <h2 style="margin-left: 30px;">Search Complaints</h3>

            <div class="row">
                <div class="col-10">
                    <label for="name">Complaint ID:</label>
                </div>
                <div class="col-90">
                    <input type="number" id="compid" name="compid" placeholder="Enter complaint ID" required maxlength="50">
                </div>
            </div>

            <br><br>
            
            <div class="row">
                <input type="submit" value="Submit" name="Submit">
            </div> 

            <!-- Printing PHP script results -->
            <?php
            // Check connection
            echo "Connecting to database....."."<br>";
            if ($conn) {
                echo "DB Connected successfully"."<br>"."<br>";
            }

            if($num_rows==0){
                echo "Complaint by Compid : $compid XXX doesn't exist";
            }else{
                if($compstatus=="Closed"){
                    echo "The complaint by compid : $compid XXX is already closed, closed complaints can’t 
                    be open";
                }else {
                    header("Location: update_page.php");
                    exit();
                }
            }
            ?>

            
        </div>
              
        </div></form> 
    </body>
</html>