<?php
    session_start();
    // Include the connection file
    require_once("connect.php");

    // Initialize error message
    $_SESSION["categories_error"] = "";

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize form data
        $catName = isset($_POST['txtCatName']) ? trim($_POST['txtCatName']) : '';
        $catImage = isset($_POST['txtCatImage']) ? trim($_POST['txtCatImage']) : '';
        $catOrder = isset($_POST['txtCatOrder']) ? (int)$_POST['txtCatOrder'] : 0;
        $catStatus = isset($_POST['txtCatStatus']) ? (int)$_POST['txtCatStatus'] : 0;

        // Validate inputs
        if (empty($catName) || empty($catImage) || !is_numeric($catOrder)) {
            $_SESSION["categories_add_error"] = "All fields are required and order must be numeric.";
            header("Location: categories_add.php");
            exit();
        }

        // Prepare SQL query to insert data into the categories table
        $sql = "INSERT INTO categories (cat_name, cat_image, cat_order, cat_status) 
          VALUES ('$catName', '$catImage', $catOrder, $catStatus)";
        
        // if (mysqli_query($conn, $query)){
        //     $_SESSION["categories_error"] = "Add Sucessful";
        //     header("Location: categories_view.php");
        }
        // Sử dụng prepare để tránh SQL Injection
    if ($stmt = $conn->prepare($sql)) {
        // Thực thi truy vấn
        if ($stmt->execute()) {
            $_SESSION["categories_error"] = "Category added successfully!";
        } else {
            $_SESSION["categories_error"] = "Error: Could not add category.";
        }

        // Đóng prepared statement
        $stmt->close();
    } else {
        $_SESSION["categories_error"] = "Error: Could not prepare statement.";
    }

    // Đóng kết nối
    $conn->close();

    // Chuyển hướng lại trang thêm danh mục
    header("Location: categories_view.php");
    exit();
?>
