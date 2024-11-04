<?php 
    session_start();
    // Check if 'upload_error' is set in the session, if not, initialize it
    if(!isset($_SESSION["upload_error"])){
        $_SESSION["upload_error"] = ""; // Initialize with an empty string
    }
    // Check if a file has been uploaded
    if(isset($_FILES['fFile'])){
        // Loop through the file's information
        foreach($_FILES['fFile'] as $k => $v){
            echo $k . " --> " . $v . "<br>"; // Display each key-value pair of the file
        }
    }
    if($_FILES["fFile"]["error"]==0){
        $source = $_FILES["fFile"]["tmp_name"];
        $dest = "images/".date("YMdhms").$_FILES["fFile"]["name"];
        $maxsize = $_POST["MAX_FILE_SIZE"];
        if($_FILES["fFile"]["size"] > $maxsize){
            $_SESSION["upload_error"] = "file must have size < ".$maxsize;
        } else {
            move_uploaded_file($source,$dest);
            $_SESSION["upload_error"] = "Sucessful";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1 align="center">Upload File to Server!</h1>
    <font color="red"><center><?php echo $_SESSION["upload_error"]; ?></center></font>
    
    <!-- The form for file upload -->
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
        <center>
            Choose file: 
            <input type="file" name="fFile"> <!-- Added name attribute to file input -->
            <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
            <input type="submit" value="Upload">
        </center>
    </form>

</body>
</html>
