<?php
    require_once("connect.php");

    $cat_id = $_GET['cat_id'];
    
    $result = $conn->query("select * from categories where cat_id = $cat_id") or die($conn->error);
    $row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Edit</title>
</head>
<body>
    <h1 align = "center">Edit categories</h1>
    <form action="categories_edit_action.php?cat_id=<?php echo $cat_id; ?>" method="post">
        <table border="0" align="center">
            <tr>
                <td align="right">categories name:</td>
                <td><input type="text" name="txtCatName" value="<?php echo $row['cat_name']; ?>"></td>
            </tr>
            <tr>
                <td align="right">categories image:</td>
                <td><input type="text" name="txtCatImage" value="<?php echo $row['cat_image']; ?>"></td>
            </tr>
            <tr>
                <td align="right">categories order:</td>
                <td><input type="text" name="txtCatOrder" value="<?php echo $row['cat_order']; ?>"></td>
            </tr>
            <tr>
                <td align="right">categories status:</td>
                <td><input type="radio" name="txtCatStatus" value="1" <?php if ($row['cat_status'] == 1) echo 'checked'; ?>>active
                    <input type="radio" name="txtCatStatus" value="0" <?php if ($row['cat_status'] == 0) echo 'checked'; ?>>inactive
                </td>
            </tr>
            <tr>
                <td><input type="submit" name = "cmd" value = "Update"></td>
                <td><input type="reset" value = "Reset"></td>
            </tr>
        </table>
    </form>
</body>
</html>