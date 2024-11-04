<?php
    require_once("connect.php");
    // Xử lý khi biểu mẫu được gửi đi
    $cat_id = $_GET['cat_id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cat_name = $_POST["txtCatName"];
        $cat_image = $_POST["txtCatImage"];
        $cat_order = $_POST["txtCatOrder"];
        $cat_status = $_POST["txtCatStatus"];

        // Cập nhật cơ sở dữ liệu
        $sql_update = "UPDATE categories SET cat_name = '$cat_name', cat_image = '$cat_image', cat_order = $cat_order, cat_status = $cat_status WHERE cat_id = $cat_id";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update->execute()) {
            $_SESSION["categories_error"] = "Category updated successfully!";
            header("Location: categories_view.php");
            exit();
        } else {
            $_SESSION["categories_view_error"] = "Error updating category!";
        }
    }
?>