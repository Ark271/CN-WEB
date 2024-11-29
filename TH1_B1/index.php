<?php
include 'config.php';

// Lấy danh sách hoa từ cơ sở dữ liệu
$stmt = $conn->prepare("SELECT * FROM flowers");
$stmt->execute();
$flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách các loài hoa</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .actions button { margin-right: 10px; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-add { margin-bottom: 20px; display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; text-align: center; }
        .btn-edit { background-color: #2196F3; color: white; }
        .btn-delete { background-color: #f44336; color: white; }
        .btn-add:hover, .btn-edit:hover, .btn-delete:hover { opacity: 0.8; }
        img { border-radius: 5px; }
    </style>
</head>
<body>
    <h1 align="center">Danh sách các loài hoa</h1>

    <!-- Nút Thêm hoa mới -->
    <a href="add.php" class="btn-add">Thêm hoa mới</a>

    <!-- Bảng danh sách hoa -->
    <table>
        <thead>
            <tr>
                <th>Tên hoa</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?= htmlspecialchars($flower['name']) ?></td>
                    <td><?= htmlspecialchars($flower['description']) ?></td>
                    <td><img src="images/<?= htmlspecialchars($flower['image']) ?>" width="80"></td>
                    <td class="actions" >
                        <!-- Nút Sửa -->
                        <button class="btn-edit"  onclick="window.location.href='edit.php?id=<?= $flower['id'] ?>'">Sửa</button>
                        <!-- Nút Xóa -->
                        <button class="btn-delete" onclick="if(confirm('Bạn có chắc chắn muốn xóa?')) window.location.href='delete.php?id=<?= $flower['id'] ?>'">Xóa</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
