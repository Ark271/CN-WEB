<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Xử lý upload ảnh
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Thêm vào cơ sở dữ liệu
    $stmt = $conn->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $image]);

    header('Location: index.php?admin');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm hoa mới</title>
</head>
<body>
    <h1>Thêm hoa mới</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên hoa:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="image">Ảnh:</label><br>
        <input type="file" id="image" name="image" required><br><br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
