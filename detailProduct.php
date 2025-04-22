<?php
session_start();
include 'database/db.php';

// Kết nối đến cơ sở dữ liệu
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin sản phẩm theo ID
    $sql = "SELECT * FROM products WHERE idP = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "San  pham khonog ton tai";
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/detailProduct.css">
    <title>Chi tiết sản phẩm</title>
</head>

<body>
    <div class="container_index">
        <?php include "includes/header.php"; ?>

        <?php if ($product): ?>
            <div class="product-detail">
                <div class="product-image">
                    <img src="<?= $product['imageP'] ?>" alt="<?= $product['nameP'] ?>">
                </div>
                <div class="product-info">
                    <h1><?= $product['nameP'] ?></h1>
                    <div class="price-info">
                        <p class="current-price">Giá: <?= number_format($product['price'], 0, ',', '.') ?>đ</p>
                        <p class="original-price">Giá gốc: <?= number_format($product['priceGoc'], 0, ',', '.') ?>đ</p>
                        <p class="discount">Giảm giá: <?= $product['discount'] ?></p>
                    </div>
                    <p><?= $product['description'] ?></p>
                    <div class="actions">
                        <a href="cart_page.php?id=<?= $product['idP'] ?>" class="button">
                            <button>Thêm vào giỏ hàng</button>
                        </a>
                        <a href="index.php" class="button">
                            <button>Quay lại</button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Không tìm thấy sản phẩm</p>
        <?php endif; ?>

        <?php include "includes/footer.php"; ?>
    </div>
</body>

</html>