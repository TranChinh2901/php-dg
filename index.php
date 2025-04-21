<?php
include 'database/db.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
}

// Kết nối đến cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/index.css">
    <!-- Bootstrap 5 JS Bundle CDN (bao gồm Popper) -->

    <title>Document</title>
</head>

<body>
    <div class="container_index">
        <?php include "includes/header.php"; ?>
        <h1>Danh sachs sản phẩm</h1>

        <div class="card_container">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="card">
                        <div class="discount-badge"><?= $row['discount'] ?></div>
                        <img src="<?= $row['imageP'] ?>" alt="Product Image">
                        <h2><?= $row['nameP'] ?></h2>
                        <div class="card_price">
                            <p><?= number_format($row['price'], 0, ',', '.') ?>đ</p>
                            <p><?= number_format($row['priceGoc'], 0, ',', '.') ?>đ</p>
                        </div>
                        <div class="card_button">
                            <a href="detailProduct.php?id=<?= $row['idP'] ?>" class="button">
                                <button>Xem chi tiết</button>
                            </a>

                            <a href="cart_page.php?id=<?= $row['idP'] ?>" class="button">
                                <button>Add cart</button>
                            </a>
                        </div>

                    </div>



                <?php endwhile; ?>
            <?php else: ?>
                <p>Không có sản phẩm nào.</p>
            <?php endif; ?>
        </div>

        <?php include "includes/footer.php"; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</html>