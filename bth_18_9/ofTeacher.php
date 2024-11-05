<?php 
    session_start();
    require_once("connect.php");
?>
<html>
	<head>
			<style type="text/css">
					body{
						margin: 0 auto;
					}
			</style>
			<meta charset=utf-8>
	</head>
	<body>
        <table border=1 cellspacing = 0 cellpadding=0 width=100%>
            <tr>
                <td colspan=2 height=120>Header</td>
            </tr>             
            <tr height=500 valign=top>
                <td width=180>
                    <?php 
                        $sql = "select * from categories where cat_status=1 order by cat_order asc";
                        $rs = $conn->query($sql) or die($conn->error);
                        if ($rs->num_rows>0){
                            while ($r = $rs->fetch_assoc()){
                                echo "<a href=?cat_id=".$r["cat_id"].">".$r["cat_name"] ."</a><br>";
                            }
                        }
                    ?>
                </td>
                <td>
                <?php 
                //git
                    if (!isset($_REQUEST["cat_id"])) {
                        $cat_id = 0;
                    } else {
                        $cat_id = $_REQUEST["cat_id"];
                    }
                    $numrows = 4;
                    if ($cat_id == 0){
                        $sql = "select * from product where p_hot=1 and p_status=1"; 
                    } else {
                        $sql = "select * from product where cat_id={$cat_id} and p_status=1"; 
                    }
                    $rs1 = $conn->query($sql) or die($conn->error);
                    if ($rs1->num_rows>0) {
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
                    //hiển thị dữ liệu 3 bản ghi trên 1 dòng 
                    ?>	
                        <table border = 1 width=100%>
                        <?php 
                                $i = 0;
                                while ($r1=$result->fetch_assoc()){
                                    $i++;
                                    if ($i == 1){
                                        echo "<tr>";
                                    }
                                    echo "<td width=33%><a href='detail.php?p_id=".$r1["p_id"]."'><h2>".$r1["p_name"]."</h2>";
                                    echo "<img width=200 src='images/".$r1["p_image"]."'></a>";
                                    echo "<p>Price: ".number_format($r1["p_price"])."<br>";
                                    echo "<a href='detail.php?p_id=".$r1["p_id"]."'>Details</a></p></td>";
                                    if ($i==3){
                                        echo "</tr>";
                                        $i = 0;
                                    }
                                }
                        ?>
                        
                        </table>
                        <center><h1>
                <?php 
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
                <tr>
                        <td colspan=2 height=120>Footer</td>
                </tr>
        
        </table>
	</body>
</html>