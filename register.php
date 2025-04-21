<?php
include "database/db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Using prepared statements to prevent SQL injection
    $sql = "INSERT INTO users (name, email, password, phone, address, gender) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $hashed_password, $phone, $address, $gender);

        if (mysqli_stmt_execute($stmt)) {
            // echo "Đăng ký thành công!";
            header("Location: login.php");
        } else {
            echo "Đăng ký thất bại: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi chuẩn bị truy vấn: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
</head>

<body>
    <?php include "includes/header.php" ?>

    <div class="container">
        <h2>Đăng ký tài khoản</h2>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Tên:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="tel" name="phone" required>
            </div>

            <div class="form-group">
                <label>Địa chỉ:</label>
                <input type="text" name="address" required>
            </div>

            <div class="form-group">
                <label>Giới tính:</label>
                <select name="gender" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>

                </select>
            </div>

            <button type="submit" name="register">Đăng Ký</button>
            <button type="submit" name="resect">
                Reload
            </button>
        </form>
    </div>

    <?php include "includes/footer.php" ?>
</body>

</html>