<?php
session_start();
include '../database/db.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "./layout/header.php" ?>
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
        <h1>Danh sachs sản phẩm</h1>
        <a href="create_product.php">Thêm sản phẩm</a>
    </div>

    <table border="1" style="width: 100%; text-align: center;">
        <tr>
            <th>id</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>giá sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giảm giá</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr class="card">
                    <td><?= $row['idP'] ?></td>
                    <td><img src="../uploads/<?= $row['imageP'] ?>" alt="Product Image" style="width: 100px; height: 100px;"></td>
                    <td><?= $row['nameP'] ?></td>
                    <td><?= number_format($row['price'], 0, ',', '.') ?>đ</td>
                    <td><?= number_format($row['priceGoc'], 0, ',', '.') ?>đ</td>
                    <td><?= $row['discount'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <a href='update_product.php?id=<?= $row['idP'] ?>'>Sửa</a>
                        <a href='delete_product.php?id=<?= $row['idP'] ?>'>Xóa</a>
                    </td>


                </tr>



            <?php endwhile; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào.</p>
        <?php endif; ?>
    </table>


</body>

</html>