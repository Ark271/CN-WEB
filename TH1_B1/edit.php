<?php
include 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM flowers WHERE id = ?");
$stmt->execute([$id]);
$flower = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $flower['image'];
    }

    $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $image, $id]);

    header('Location: index.php?admin');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin hoa</title>
</head>
<body>
    <h1>Sửa thông tin hoa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên hoa:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($flower['name']) ?>" required><br><br>

        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" required><?= htmlspecialchars($flower['description']) ?></textarea><br><br>

        <label for="image">Ảnh:</label><br>
        <input type="file" id="image" name="image"><br><br>
        <img src="images/<?= htmlspecialchars($flower['image']) ?>" width="100"><br><br>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
