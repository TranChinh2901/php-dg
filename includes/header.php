<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Header</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 20px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
            margin-left: 20px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #007bff;
            min-width: 160px;
            z-index: 1;
            right: 0;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #0056b3;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php">Logo</a>
        </div>
        <nav>
            <a href="index.php">Trang chủ</a>
            <a href="about.php">Giới thiệu</a>
            <a href="contact.php">Liên hệ</a>

            <div class="dropdown">
                <button>
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo "Chào, " . htmlspecialchars($_SESSION['email']) . " 🔽";
                    } else {
                        echo "Tài khoản 🔽";
                    }
                    ?>
                </button>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="profile_user.php">Hồ sơ</a>
                        <a href="cart.php">Giỏ hàng</a>
                        <a href="logout.php">Đăng xuất</a>
                    <?php else: ?>
                        <a href="login.php">Đăng nhập</a>
                        <a href="register.php">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>