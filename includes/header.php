<?php

?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Trang Web Của Bạn</title>
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

        .logo {
            font-size: 20px;
            font-weight: bold;
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
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #007bff;
            min-width: 160px;
            z-index: 1;
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

        /* Icon style */
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
                        echo "Welcome, " . htmlspecialchars($_SESSION['email']) . " 🔽";
                    } else {
                        echo "Account 🔽";
                    }
                    ?>
                </button>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['email'])): ?>
                        <a href="">Profile</a>
                        <a href="">Cart</a>
                        <a href="logout.php">Logout</a>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    <?php endif; ?>
                </div>
            </div>

        </nav>
    </header>
</body>

</html>