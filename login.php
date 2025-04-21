<?php
include "database/db.php";
session_start();

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Kiểm tra email và mật khẩu có tồn tại hay không
    if (empty($email) || empty($password)) {
        $error = "❌ Email hoặc password không được để trống";
    } else {
        // Sử dụng prepared statement để tránh SQL injection
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Sử dụng password_verify để kiểm tra mật khẩu đã hash
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $user['role'];
                $_SESSION['gender'] = $user['gender'];
                $_SESSION['user_id'] = $user['id']; // Thêm user_id vào session nếu cần

                //Điều hướng theo role
                if ($user['role'] == 1) {
                    header('Location: admin/index.php');
                    exit();
                } else {
                    header('Location: index.php');
                    exit();
                }
            } else {
                $error = "❌ Mật khẩu không chính xác";
            }
        } else {
            $error = "❌ Email không tồn tại";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "includes/header.php" ?>
    <form action="login.php" method="POST" style="width: 100%; margin: 0 auto;">
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="flex-label">
            <label>Email</label>
            <input type="text" name="email">
        </div>
        <br>
        <label>Password</label>
        <input type="password" name="password">
        <br>
        <button type="submit" name="login">
            Login
        </button>
        <button type="submit" name="resect">
            Reload
        </button>

        <div class="if-you-dont-have-an-account">
            Nếu bạn chưa có tk > <a href="register.php"> register</a>
        </div>

    </form>

    <div class="container_index">
        <?php include "includes/footer.php"; ?>
</body>

</html>