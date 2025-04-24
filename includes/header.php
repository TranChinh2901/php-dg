<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Header Hiện Đại</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php"><i class="fa-brands fa-php"></i> PHPBASIC</a>
        </div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Trang chủ</a>
            <a href="products.php"><i class="fas fa-info-circle"></i> Sản phẩm</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Liên hệ</a>

            <div class="dropdown">
                <button>
                    <i class="fas fa-user-circle"></i>
                    <?php
                    if (isset($_SESSION['name'])) {
                        echo htmlspecialchars($_SESSION['name']);
                    } else {
                        echo "Tài khoản";
                    }
                    ?>

                    <i class="fas fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <?php if (isset($_SESSION['name'])): ?>
                        <?php if ($_SESSION['role'] == 0):
                        ?>
                            <a href="profile_user.php"><i class="fas fa-user"></i> Hồ sơ</a>
                            <a href="cart.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                        <?php elseif ($_SESSION['role'] == 1):
                        ?>
                            <a href="../admin/index.php"><i class="fas fa-user"></i> Dashboard</a>
                            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                        <a href="register.php"><i class="fas fa-user-plus"></i> Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</body>

</html>