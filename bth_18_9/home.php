<?php
    session_start();
    require_once("connect.php");

    $p_id = $_REQUEST["p_id"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type = "text/css">
        body{
            margin: 0 auto;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table border = 1 cellspacing = 0 cellpadding = 0 width = 100%>
        <tr>
            <td colspan = 2 height = 120>Header</td>
        </tr>
        <tr height = 500 valign = top>
            <td width = 180>
                <?php
                    $sql = "select * from categories where cat_status = 1 order by cat_order asc";
                    $rs = $conn->query($sql) or die($conn->error);
                    if($rs->num_rows > 0){
                        while ($r = $rs->fetch_assoc()){
                            echo "<a href=?cat_id=".$r["cat_id"].">".$r["cat_name"]."</a><br>";
                        }
                    }
                ?>
            </td>
            <td>
            <?php
            // xu lu phan hien thi san phan cua tung trang, hien 3 san pham mot dong
                if (!isset($_REQUEST["cat_id"])) {
                    $cat_id = 0;
                } else {
                    $cat_id = $_REQUEST["cat_id"];
                }
                $numrows = 4;
                if($cat_id == 0){
                    $sql = "select * from product where p_hot=1 and p_status=1"; 
                }else{
                    $sql = "select * from product where cat_id = {$cat_id}"; 
                }
                $rs1 = $conn->query($sql) or die($conn->error);
                if($rs1->num_rows > 0){
                    $numpages = ceil($rs1->num_rows / $numrows);
                    if (!isset($_REQUEST["page"])) {
                        $page = 1;
                    } else {
                    $page = $_REQUEST["page"];
                    }
                    if ($page<1) $page = 1;
                    if ($page > $numpages) $page = $numpages;
                    $sql .=" limit ". ($page-1)*$numrows." , ". $numrows;
                    $result = $conn->query($sql) or die($conn->error);
                    
            ?>
            <table border = 1 width = 100%>
                <?php
                    $i = 1;
                    while($r1 = $result->fetch_assoc()){
                        if($i == 1){
                        echo "<tr>";
                        }
                        echo "<td width=33%><a href='detail.php?p_id=".$r1["p_id"]."'><h2>".$r1["p_name"]."</h2>";
                        echo "<img width=200 src='images/".$r1["p_image"]."'></a>";
                        echo "<p>Price: ".number_format($r1["p_price"])."<br>";
                        echo "<a href='detail.php?p_id=".$r1["p_id"]."'>Details</a></p>";  //</td>
                        
                ?>
                <!-- xu ly phan danh gia -->
                <form action="" method = "get">
                    <p>Đánh Giá</p>
                    <select name="rating" >
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                    <input type="hidden" name = "p_id" value = "<?php echo $r1["p_id"]; ?>">
                    <input type="submit">
                </form>
                <p>Lượt đánh giá</p>
                <br>
                <table>
                    <tr>
                        <td>1 sao</td>
                        <td>2 sao</td>
                        <td>3 sao</td>
                        <td>4 sao</td>
                        <td>5 sao</td>
                    </tr>
                    <?php
                        $sql1 = "select * from rate_star join product on rate_star.rs_id = product.rs_id where p_id = {$p_id}";
                        $rs1 = $conn->query($sql1) or die($conn->error);
                        echo "<tr>";
                        while ($r2 = $rs1->fetch_assoc()){
                            echo $rs["one_star"];
                            echo $rs["two_star"];
                            echo $rs["three_star"];
                            echo $rs["four_star"];
                            echo $rs["five_star"];
                        }
                        echo "</tr>";
                    ?>
                </table>
                <?php
                    echo "</td>";
                        if ($i == 2){
                            echo "</tr>";
                            $i = 0;
                        }
                        $i++;
                    }
                ?>
            </table>
            <center><h1>
                <?php 
                // hien so phan trang
                    for($i = 1;$i<=$numpages;$i++){
                            if ($i == $page) {
                                echo " ".$i. " ";
                            } else {
                                echo " <a href='?page=$i&cat_id={$cat_id}'>$i</a> ";
                            }
                        
                    }
                ?>
                </h1>
            </center>
                                        
                    <?php
                        }
                    ?>
                    </td>
                </tr>
            </td>
        </tr>
        <tr>
            <td colspan = 2 height = 120>Footer</td>
        </tr>
    </table>
</body>
</html>