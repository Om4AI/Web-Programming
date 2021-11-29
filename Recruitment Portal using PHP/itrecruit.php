<html>
<head>
    <style>
    *{
        color: red;
        text-align: justify;
        margin: 5%;
        font-family: monospace;
    }
    </style>
<link rel="stylesheet" href="prod_style.css">
</head>    
<body>
<?php

// ----------------------------FILE UPLOADS-----------------------------
$target_dir = "uploads/";

// Generate the final path of the file in uploads folder
$resume_target_file = $target_dir.basename($_FILES['resumeupload']['name']);
$img_target_file = $target_dir.basename($_FILES['imgupload']['name']);
$img_target_filee = $target_dir.basename($_FILES['imgupload1']['name']);
$uploadOk = 1;
$rfiletype = strtolower(pathinfo($resume_target_file, PATHINFO_EXTENSION));
$ifiletype = strtolower(pathinfo($img_target_file, PATHINFO_EXTENSION));
$ifiletypee = strtolower(pathinfo($img_target_filee, PATHINFO_EXTENSION));


// Check file type (doc or pdf)
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES['resumeupload']['tmp_name']);
    if ($check!== true){
        echo "<br>"."File has proper size"."<br>";  
        $uploadOk = 1;
    }else{
        echo "File is not of correct size.";
        $uploadOk = 0;
    }
}

// Check file size
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES['imgupload']['tmp_name']);
    if ($check!== true && getimagesize($_FILES['imgupload1']['tmp_name'])){
        echo "Uploaded image has proper size"."<br>";  
        $uploadOk = 1;
    }else{
        echo "Uploaded image is not of correct size.";
        $uploadOk = 0;
    }
}

// Check if file already exists (Resume)
if (file_exists($resume_target_file) ) {
    echo "<br>"."Sorry, resume already exists.";
    $uploadOk = 0;
}

if (file_exists($img_target_file)) {
    echo "<br>"."Sorry, Photo already exists.";
    $uploadOk = 0;
}

if (file_exists($img_target_filee)) {
    echo "<br>"."Sorry, Digital Signature already exists.";
    $uploadOk = 0;
}

// Allow certain file formats (Resume)
if($rfiletype != "docx" && $rfiletype != "pdf") {
    echo "<br>"."Sorry, only doc or pdf files allowed for resume.";
    $uploadOk = 0;
}

// Allow certain file formats (Image)
if($ifiletype != "jpg" && $ifiletype != "png" && $ifiletype != "jpeg") {
    echo "<br>"."Sorry, only jpg, jpeg & png formats supported for photo.";
    $uploadOk = 0;
}

if($ifiletypee != "jpg" && $ifiletypee != "png" && $ifiletypee != "jpeg") {
    echo "<br>"."Sorry, only jpg, jpeg & png formats supported for digital signature.";
    $uploadOk = 0;
}

// Check file size (Resume)
if ($_FILES['resumeupload']['size'] > 5000000) {
    echo "<br>"."Sorry, your resume file is too large.";
    $uploadOk = 0;
}

// Check file size (Image)
if ($_FILES['imgupload']['size'] > 500000 || $_FILES['imgupload1']['size'] > 500000) {
    echo "<br>"."Sorry, your image file is too large.";
    $uploadOk = 0;
}

$uploaded = 0;

// Upload the file if all conditions satisfy
if($uploadOk==1 && move_uploaded_file($_FILES['resumeupload']['tmp_name'], $resume_target_file) && move_uploaded_file($_FILES['imgupload']['tmp_name'], $img_target_file) && move_uploaded_file($_FILES['imgupload1']['tmp_name'], $img_target_filee)) {  
    $uploaded=1;
} else{   
    $uploaded = 0;
}
// ----------------------------FILES UPLOADED----------------------------


// --------------------------RECEIVE VARIABLE NAMES---------------------
$name = $_POST["name"];
$jt = $_POST["jt"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$dob = $_POST["dob"];
$univ = $_POST["univ"];


// Verify the presence of University in the university list
$unis = file_get_contents("Univs.txt");
$unis = explode("\n", $unis);
$present = 0;
foreach($unis as $s){
    if (strcmp(strtolower($univ),strtolower($s))){
        $present=1;
        break;
    }
}

// Print if university is valid or not
if ($present==1){
    echo "<br>". "University is Valid!";
}else echo "<br>"."University Invalid";

// Uppercase conversion
$name = strtoupper($name);
?>

<!-- Print the results -->
<p style="font-size:20px; margin: 0px;">
<?php echo "<br>". "<br>". "Job Title Applied &nbsp &nbsp"; 
echo ":&nbsp &nbsp".$jt;

?></p>

<!-- Print all the submitted details -->

<p style="font-size:20px; margin: 0px; "><?php echo "Name  &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp &nbsp:&nbsp &nbsp$name"; ?></p>
<p style="font-size:20px; margin: 0px;"><?php echo "Mobile No.&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp:&nbsp &nbsp9XXXX 3YYYY"; ?></p>
<p style="font-size:20px; margin: 0px;"><?php echo "E-MAIL&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp:&nbsp &nbsp$email"; ?></p>
<p style="font-size:20px; margin: 0px;"><?php echo "Date of Birth &nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp &nbsp$dob"; ?></p>



<!-- File upload status -->
<p style="font-size:20px; margin: 0px;">
<?php
if ($uploaded == 1){
    echo "Files Uploaded successfully"; 
}
?></p>

</body></html>