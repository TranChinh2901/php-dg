<?php
session_start();
include 'database/db.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Debug - có thể xóa sau khi kiểm tra xong
$debug = false;
if ($debug) {
    echo "<div style='background-color: #f8f9fa; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd;'>";
    echo "<h3>Debug Session:</h3>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="./assets/styles/index.css">
    <style>
        .container_index {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .user-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .user-info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .logout-btn {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="container_index">
        <h1>Thông tin cá nhân</h1>

        <div class="user-info">
            <p><strong>Tên:</strong> <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Không có thông tin'; ?></p>
            <p><strong>Email:</strong> <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Không có thông tin'; ?></p>
            <p><strong>Giới tính:</strong> <?php echo isset($_SESSION['gender']) ? htmlspecialchars($_SESSION['gender']) : 'khongo co thong tin' ?></p>
            <p><strong>Vai trò:</strong> <?php echo isset($_SESSION['role']) && $_SESSION['role'] == 1 ? 'Admin' : 'User'; ?></p>
        </div>

        <a href="logout.php" class="logout-btn">Đăng xuất</a>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>