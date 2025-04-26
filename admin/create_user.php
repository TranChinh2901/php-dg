<?php
session_start();
include '../database/db.php';
$error_message = '';

if (isset($_POST['taomoiuser'])) {
    // Sử dụng mysqli_real_escape_string để tránh SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $role = isset($_POST['role']) ? 1 : 0;

    if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address) || empty($gender)) {
        $error_message = 'Vui lòng điền đầy đủ thông tin!';
    } else {
        // Sử dụng Prepared Statement để tránh SQL injection
        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $check_email);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $error_message = 'Email đã tồn tại! Vui lòng chọn email khác.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password, phone, address, gender, role) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $hashed_password, $phone, $address, $gender, $role);

            if (mysqli_stmt_execute($stmt)) {
                header('Location:user_list.php');
                exit();
            } else {
                $error_message = 'Lỗi khi thêm người dùng: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo mới người dùng</title>
</head>

<body>

    <?php include "./layout/header.php" ?>
    <h1>Tạo mới người dùng</h1>

    <?php if (!empty($error_message)): ?>
        <div style="color: red; margin-bottom: 10px;">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="create_user.php" method="post">
        <label for="name">Tên đăng nhập:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="phone">Số điện thoại:</label><br>
        <input type="text" id="phone" name="phone" required><br>

        <label for="address">Địa chỉ:</label><br>
        <input type="text" id="address" name="address" required><br>

        <label for="gender">Giới tính:</label><br>
        <select name="gender" id="gender" required>
            <option value="">Chọn giới tính</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br>



        <input type="submit" value="Tạo mới" name="taomoiuser">
    </form>
    <button onclick="window.location.href='./user_list.php'">Quay lại</button>
</body>

</html>