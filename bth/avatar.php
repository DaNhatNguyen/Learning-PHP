<?php
// Đường dẫn đến thư mục lưu trữ ảnh
$uploadDir = 'uploads/';

// Hàm kiểm tra và xử lý việc tải ảnh lên
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']); // lấy ra đường dẫn chi tiết
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION)); // lấy ra đuôi mở rộng của file

    // Kiểm tra xem tệp có phải là hình ảnh không
    $check = getimagesize($_FILES['avatar']['tmp_name']);
    if ($check === false) {
        echo "File không phải là ảnh.";
        exit;
    }

    // Kiểm tra kích thước tệp
    if ($_FILES['avatar']['size'] > 500000) {
        echo "File quá lớn.";
        exit;
    }

    // Chỉ cho phép một số định dạng ảnh nhất định
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Chỉ cho phép các định dạng JPG, JPEG, PNG & GIF.";
        exit;
    }

    // Kiểm tra và tải tệp lên
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
        echo "Ảnh đã được tải lên thành công.";
    } else {
        echo "Có lỗi xảy ra khi tải ảnh.";
    }
}

// $scans = scandir($uploadDir);
// var_dump($scans);
// Lấy danh sách các ảnh đã tải lên
$images = array_diff(scandir($uploadDir), ['..', '.']);
//scandir(): dùng để quét, liệt kê các tệp và thư mục có trong thư mục chỉ định
// array_diff(): dùng để so sánh hai hoặc nhiều mảng, 
//trả về phần tử có trong mảng đầu tiên nhưng kh có trong mảng thứ 2(và các mảng tiếp theo)
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải ảnh lên làm avatar</title>
</head>
<body>
    <h1>Chọn ảnh làm avatar</h1>

    <!-- Phần hiển thị các ảnh có sẵn -->
    <div>
        <h2>Ảnh đã có sẵn:</h2>
        <?php if (!empty($images)): ?>
            <form method="POST" action="">
                <div style="display: flex; gap: 10px;">
                    <?php foreach ($images as $image): ?>
                        <label>
                            <input type="radio" name="selected_image" value="<?php echo $image; ?>">
                            <img src="<?php echo $uploadDir . $image; ?>" alt="Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                        </label>
                    <?php endforeach; ?>
                </div>
                <br>
                <button type="submit" name="set_avatar">Chọn làm avatar</button>
            </form>
        <?php else: ?>
            <p>Không có ảnh nào.</p>
        <?php endif; ?>
    </div>

    <hr>

    <!-- Phần tải ảnh mới lên -->
    <div>
        <h2>Tải ảnh mới lên:</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="avatar" required>
            <br><br>
            <button type="submit">Tải ảnh lên</button>
        </form>
    </div>

    <?php
    // Xử lý việc chọn ảnh làm avatar
    if (isset($_POST['set_avatar'])) {
        if (!empty($_POST['selected_image'])) {
            $selectedImage = $_POST['selected_image'];
            echo "<h3>Avatar đã chọn:</h3>";
            echo "<img src='" . $uploadDir . $selectedImage . "' alt='Avatar' style='width: 150px; height: 150px; object-fit: cover;'>";
        } else {
            echo "Chưa chọn ảnh nào.";
        }
    }
    ?>
</body>
</html>
