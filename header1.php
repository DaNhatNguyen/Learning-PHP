<?php $g_nSubmit= $_REQUEST["nSubmit"]; 
    if ($g_nSubmit=null) $g_nSubmit=0; else $g_nSubmit++; 
    if ($g_nSubmit>5) { header ("Location: ham.html"); 
        exit; 
    }else if ($g_nSubmit>3) echo "Submit gi ma nhieu the?<br>";
    echo "$g_nSubmit<br>"; 
?> 
<FORM method="POST" name="AForm"> 
    <input type="hidden" name="nSubmit" value="<?=$g_nSubmit; ?>"> 
    <INPUT TYPE="SUBMIT" name="Submit" value="Submit"><br> 
</FORM>