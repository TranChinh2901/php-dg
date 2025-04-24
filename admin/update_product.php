<?php
include '../database/db.php';
session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION['email']) || $_SESSION['role'] != 1) {
    header('location:././login.php');
    exit();
}

$message = '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy dữ liệu sản phẩm hiện tại
$sql_select = "SELECT * FROM products WHERE idP = ?";
$stmt_select = mysqli_prepare($conn, $sql_select);
mysqli_stmt_bind_param($stmt_select, "i", $id);
mysqli_stmt_execute($stmt_select);
$result = mysqli_stmt_get_result($stmt_select);
$product = mysqli_fetch_assoc($result);

// Nếu submit form cập nhật
if (isset($_POST['update'])) {
    $nameP = $_POST['name'];
    $price = $_POST['price'];
    $priceGoc = $_POST['priceGoc'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];

    // Xử lý ảnh: nếu có upload mới thì cập nhật, không thì giữ nguyên
    if (!empty($_FILES['image']['name'])) {
        $imageP = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_image, '../uploads/' . $imageP);
    } else {
        $imageP = $product['imageP'];
    }

    // Cập nhật sản phẩm
    $sql_update = "UPDATE products SET nameP=?, imageP=?, price=?, priceGoc=?, discount=?, description=? WHERE idP=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, 'ssddssi', $nameP, $imageP, $price, $priceGoc, $discount, $description, $id);

    if (mysqli_stmt_execute($stmt_update)) {
        $message = "<p class='success'>Cập nhật thành công!</p>";
        // Cập nhật lại dữ liệu để load form mới
        $product['nameP'] = $nameP;
        $product['imageP'] = $imageP;
        $product['price'] = $price;
        $product['priceGoc'] = $priceGoc;
        $product['discount'] = $discount;
        $product['description'] = $description;

        header('Location:product_list.php');
    } else {
        $message = "<p class='error'>Cập nhật thất bại: " . mysqli_error($conn) . "</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Cập nhật sản phẩm</title>
</head>

<body>
    <?= $message ?>
    <form method="POST" enctype="multipart/form-data">
        <h1>Cập nhật sản phẩm</h1>

        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['nameP']) ?>" required><br>

        <label for="price">Giá sản phẩm:</label>
        <input type="number" id="price" name="price" value="<?= $product['price'] ?>" required><br>

        <label for="priceGoc">Giá gốc:</label>
        <input type="number" id="priceGoc" name="priceGoc" value="<?= $product['priceGoc'] ?>" required><br>

        <label for="discount">Giảm giá:</label>
        <input type="number" id="discount" name="discount" value="<?= $product['discount'] ?>"><br>

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>

        <label>Hình ảnh hiện tại:</label>
        <img src="../uploads/<?= $product['imageP'] ?>" width="100"><br>

        <label for="image">Chọn ảnh mới (nếu có):</label>
        <input type="file" id="image" name="image"><br>

        <div>
            <button type="submit" name="update">Cập nhật</button>
            <button type="button" onclick="window.location.href='product_list.php'">Quay lại</button>
        </div>
    </form>
</body>

</html>