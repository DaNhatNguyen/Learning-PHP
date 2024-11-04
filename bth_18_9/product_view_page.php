<?php
    require_once("connect.php");
    $numrows = 2; // sô bản ghi trong một trang
    $sql = "select * from product";
    $rs = $conn->query($sql) or die($conn->error);
    $numpages = ceil($rs->num_rows/$numrows);
    //echo $rs->num_rows; tổng số bản ghi
    if(!isset($_REQUEST["page"])){
        $page = 1;
    } else {    
        $page = $_REQUEST["page"];
    }
    if($page < 1) $page = 1;
    if($page > $numpages) $page = $numpages;
    $sql .= " limit ".($page-1)*$numrows." , ".$numrows; // limit: lấy số bản ghi theo chỉ số
    $result = $conn->query($sql) or die($conn->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List of product</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th> Product Image</th>
            <th> Product Quantity</th>
            <th> Product Price</th>
        </tr>
        <?php
            while ($row=$result->fetch_assoc()){
                echo "<tr><td>".$row["p_id"]."</td>";
                echo "<td>".$row["p_name"]."</td>";
                echo "<td><img src = 'images/".$row["p_image"]."'></td>";
                echo "<td>".$row["p_quantity"]."</td>";
                echo "<td>".$row["p_price"]."</td>";
            }
        ?>
    </table>
    <?php
        for ($i=1; $i <= $numpages; $i++) { 
            if($i == $page){
                echo " ".$i." ";
            } else{
                echo "<a href = ?page=".$i.">"." ".$i." "."</a>";
            }
        }
    ?>
</body>
</html>