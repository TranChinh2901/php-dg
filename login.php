<?php
session_start();
include 'database/db.php';

$error = "";

// Kiểm tra kết nối database
if (!$conn) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Kiểm tra email và mật khẩu có tồn tại hay không
    if (empty($email) || empty($password)) {
        $error = "❌ Email hoặc password không được để trống";
    } else {
        // Sử dụng prepared statement để tránh SQL injection
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                // Debug - có thể xóa sau khi kiểm tra
                // echo "Password nhập: " . $password . "<br>";
                // echo "Hash trong DB: " . $user['password'] . "<br>";
                // echo "Verify result: " . (password_verify($password, $user['password']) ? 'TRUE' : 'FALSE') . "<br>";

                // Sử dụng password_verify để kiểm tra mật khẩu đã hash
                if (password_verify($password, $user['password'])) {
                    // Lưu thông tin user vào session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['gender'] = $user['gender'];

                    // Điều hướng theo role
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
                $error = "❌ Email không tồn tại trong hệ thống";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "❌ Lỗi hệ thống: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-reset {
            background-color: #6c757d;
            color: white;
        }

        .btn-reset:hover {
            background-color: #545b62;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include "includes/header.php" ?>

    <div class="login-container">
        <div class="login-form">
            <h2>Đăng nhập</h2>

            <form action="login.php" method="POST">
                <?php if (!empty($error)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="login" class="btn btn-login">
                        Đăng nhập
                    </button>
                    <button type="reset" class="btn btn-reset">
                        Làm mới
                    </button>
                </div>

                <div class="register-link">
                    Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>