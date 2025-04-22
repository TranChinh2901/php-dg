<?php
session_start();
include 'database/db.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="container_index">
        <h1>Producst</h1>

        <div>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="card">
                        <div class="discount-badge"><?= $row['discount'] ?></div>
                        <img src="./uploads/<?= $row['imageP'] ?>" alt="Product Image">
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
    </div>
    <?php include "includes/footer.php" ?>
</body>

</html>