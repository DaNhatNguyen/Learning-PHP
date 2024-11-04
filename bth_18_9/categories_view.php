<?php
    session_start();
    if(!isset($_SESSION["categories_error"])){
        $_SESSION["categories_error"] = "";
    }
    require_once("connect.php");
    $result = $conn->query("select * from categories") or die($conn->error);
    //var_dump($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <center>
        <h1>Categories List</h1>
        <font color = "red"><?php echo $_SESSION["categories_error"];?></font>
        <table border = 1px width = 800px>
            <tr>
                <th>Cat ID</th>
                <th>Cat Name</th>
                <th>Cat Image</th>
                <th>Cat Order</th>
                <th>Cat Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
                if($result->num_rows==0){
                    echo "<tr><td colspan = 7>No Record!</td></tr>";
                }else {
                    while ($row=$result->fetch_assoc()){
                        echo "<tr><td>".$row["cat_id"]."</td>";
                        echo "<td>".$row["cat_name"]."</td>";
                        echo "<td><img src = 'images/".$row["cat_image"]."'></td>";
                        echo "<td>".$row["cat_order"]."</td>";
                        echo "<td>".($row["cat_status"] ==1?"Active":"Inactive")."</td>";
                        echo "<td><a href = categories_edit.php?cat_id=".$row["cat_id"]."><img src = images/edit.png width = 20px></td>";
                        echo "<td><a href = categories_delete.php?cat_id=".$row["cat_id"]."><img src = images/delete.png width = 20px></td></tr>";
                    }
                }
            ?>
        </table>
        <a href="categories_add.php">Add new</a>
    </center>
    <?php
        $_SESSION["categories_error"] = "";
        $conn->close();
    ?>
</body>
</html>