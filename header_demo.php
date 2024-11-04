<?php 
    $g_nSubmit = isset($_REQUEST["nSubmit"]) ? $_REQUEST["nSubmit"] : 0; 
    $g_nSubmit++; 

    if ($g_nSubmit > 5) { 
        header("Location: header_demo.php"); 
        exit; 
    } else if ($g_nSubmit > 3) { 
        echo "Submit nhiều quá rồi!<br>";
    } 

    echo "$g_nSubmit<br>"; 
?> 

<FORM method="POST" name="AForm"> 
    <input type="hidden" name="nSubmit" value="<?= $g_nSubmit; ?>"> 
    <INPUT TYPE="SUBMIT" name="Submit" value="Submit"><br> 
</FORM>
