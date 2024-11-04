<?php
    require_once("connect.php");

    $cat_id = $_GET['cat_id'];

    $sql = "DELETE FROM categories WHERE cat_id = $cat_id;";

    if ($stmt = $conn->prepare($sql)) {
        // Thực thi truy vấn
        if ($stmt->execute()) {
            $_SESSION["categories_delete"] = "Category deleted successfully!";
        } else {
            $_SESSION["categories_delete"] = "Error: Could not delete category.";
        }

        // Đóng prepared statement
        $stmt->close();
    } else {
        $_SESSION["categories_error"] = "Error: Could not prepare statement.";
    }

    $conn->close();

    // Chuyển hướng lại trang thêm danh mục
    header("Location: categories_view.php");
    exit();

?>
