<?php
    session_start();
    require_once("connect.php");

    // $p_id = $_REQUEST["p_id"] ?? "";

    //xử lý đối với giỏ hàng 
    if (!empty($_GET["action"])){
        switch($_GET["action"]){
            case "add":
                if (!empty($_POST["quantity"])){
                    $p_id = $_GET["p_id"];
                    $productbypid = $conn->query("select * from Product where p_id=".$p_id) or die($conn->error);
                    $r[] = $productbypid->fetch_assoc();
                    // var_dump($r[0]);
                    $itemArray = array($r[0]["p_code"]=>array(
                                "p_id"=>$r[0]["p_id"],
                                "p_code"=>$r[0]["p_code"],
                                "p_name"=>$r[0]["p_name"],
                                "p_price"=>$r[0]["p_price"],
                                "p_quantity"=>$_POST["quantity"],
                                "p_image"=>$r[0]["p_image"])
                    );
                    // var_dump($itemArray);
                    if (empty($_SESSION["cart_item"])){
                            //giỏ hàng rỗng 
                            $_SESSION["cart_item"] = $itemArray;
                    } else {
                            //giỏ hàng không rỗng
                            //kiểm tra xem hàng có trong giỏ hay không
                            //var_dump($r[0]["p_code"]);
                            if (in_array($r[0]["p_code"],array_keys($_SESSION["cart_item"]))){
                                //nếu sản phầm đã có trong giỏ hàng 
                                foreach ($_SESSION["cart_item"] as $k=>$v){
                                    if ($r[0]["p_code"]==$k){
                                    if (empty($_SESSION["cart_item"][$k]["p_quantity"])){
                                            $_SESSION["cart_item"][$k]["p_quantity"] = 0;
                                    }		
                                    $_SESSION["cart_item"][$k]["p_quantity"] +=$_POST["quantity"];
                                    }	
                                }
                                
                                
                            } else {
                                //sản phẩm chưa có trong giỏ hàng 
                                $_SESSION["cart_item"] = array_merge_recursive($_SESSION["cart_item"],$itemArray);
                                
                            }
                            
                    }
                    
                }
                //unset($_SESSION["cart_item"]);
                //echo "<h1>";
                //var_dump($_SESSION["cart_item"]);
            break;
            case "remove":
                if (!empty($_SESSION["cart_item"])){
                    foreach($_SESSION["cart_item"] as $k=>$v){
                        if ($_GET["p_code"]==$k){
                            unset($_SESSION["cart_item"][$k]);
                        if (empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                        }
                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
            break;
            case "payment":
                if (!isset($_SESSION["loginuser"])){
                    $_SESSION["loginuser"] = false;
                }
                if ($_SESSION["loginuser"]==false){
                        $_SESSION["login_error"] = "Please Login!";
                        header("Location:login_user.php");
                }
            break;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            <!-- Phần Navigation  -->
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
            <div>Shopping Cart
                <a href=?action=payment>Payment</a> 
                <a href=?action=empty>Empty Cart</a>
                <br>
                <table align=center border=1>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                    <?php 
                        $total = 0;
                        if (!empty($_SESSION["cart_item"])){
                            foreach ($_SESSION["cart_item"] as $item){
                                $total +=$item["p_price"]*$item["p_quantity"];
                    ?>
                        <tr>
                            <td><img width=50px src="images/<?php echo $item["p_image"];?>"><?php echo $item["p_name"];?></td>
                            <td><?php echo $item["p_code"];?></td>
                            <td><?php echo $item["p_quantity"];?></td>
                            <td align=right><?php echo number_format($item["p_price"],0);?></td>
                            <td><a href=?action=remove&p_code=<?php echo $item["p_code"];?>>Remove</a></td>
                        </tr>
                    <?php 
                            }
                        }
                    ?>
                    <tr>
                        <th colspan=3>Total:</th>
                        <td align=right><?php echo number_format($total,0);?></td>
                    </tr>
                </table>
            </div>


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
                    // Hien thi san pham
                    $i = 1;
                    while($r1 = $result->fetch_assoc()){
                        if($i == 1){
                        echo "<tr>";
                        }
                        echo "<td width=33%><form method=POST action='?action=add&p_id=".$r1["p_id"]."'>";
                        echo "<a href='detail.php?p_id=".$r1["p_id"]."'><h2>".$r1["p_name"]."</h2>";
                        echo "<img width=200 src='images/".$r1["p_image"]."'></a>";
                        echo "<p>Price: ".number_format($r1["p_price"])."<br>";
                        echo "<a href='detail.php?p_id=".$r1["p_id"]."'>Details</a></p>";  //
                        echo "<input type=text class=product-quantity name=quantity value=1 size=2>";
						echo "<input type=submit value='Add to Cart' class=btnAddAction></form></td>";
                        if ($i == 3){
                            echo "</tr>";
                            $i = 0;
                        }
                        $i++;
                    }
                ?>         
                </table>
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