<?php
    session_start();
    if(!isset($_SESSION["categories_add_error"])){
        $_SESSION["categories_add_error"] = "";  
    }
    require_once("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Add</title>
</head>
<body>
    <h1 align = "center">Add new categories</h1>
    <center>
        <font color = "red"><?php echo $_SESSION["categories_add_error"];?></font>
    </center>
    <form action="categories_add_action.php" method="post">
        <table border="0" align="center">
            <tr>
                <td align="right">categories name:</td>
                <td><input type="text" name="txtCatName"></td>
            </tr>
            <tr>
                <td align="right">categories image:</td>
                <td><input type="text" name="txtCatImage"></td>
            </tr>
            <tr>
                <td align="right">categories order:</td>
                <td><input type="text" name="txtCatOrder"></td>
            </tr>
            <tr>
                <td align="right">categories status:</td>
                <td><input type="radio" name="txtCatStatus" value="1" >active
                    <input type="radio" name="txtCatStatus" value="0" >inactive
                </td>
            </tr>
            <tr>
                <td><input type="submit" name = "cmd" value = "Submit"></td>
                <td><input type="reset" value = "Reset"></td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php $_SESSION["categories_add_error"] = "";?>
