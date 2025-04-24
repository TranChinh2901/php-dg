<?php
include '../database/db.php';
$error_message = '';

if (isset($_POST['taomoi'])) {
    // Kiểm tra xem các biến có tồn tại không
    $name = isset($_POST['nameP']) ? $_POST['nameP'] : '';
    $image = isset($_FILES['imageP']) ? $_FILES['imageP'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $priceGoc = isset($_POST['priceGoc']) ? $_POST['priceGoc'] : '';
    $discount = isset($_POST['discount']) ? $_POST['discount'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if (empty($name) || empty($image['name']) || empty($price) || empty($priceGoc) || empty($discount) || empty($description)) {
        $error_message = 'Vui lòng điền đầy đủ thông tin!';
    } else {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image["name"]);

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $image_name = $image['name'];
            $sql = "INSERT INTO products (nameP, imageP, price, priceGoc, discount, description) VALUES ('$name', '$image_name', '$price', '$priceGoc', '$discount', '$description')";

            if (mysqli_query($conn, $sql)) {
                header('location:./product_list.php');
                exit();
            } else {
                $error_message = 'Lỗi khi thêm sản phẩm: ' . mysqli_error($conn);
            }
        } else {
            $error_message = 'Lỗi khi tải lên hình ảnh.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>

<body>
    <?php include "./layout/header.php"; ?>

    <h1>Create products</h1>
    <?php if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    } ?>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nameP">Tên sản phẩm</label>
            <input type="text" name="nameP" id="nameP" required>
        </div>
        <div>
            <label for="price">Giá sản phẩm</label>
            <input type="number" name="price" id="price" required>
        </div>
        <div>
            <label for="priceGoc">Giá gốc</label>
            <input type="number" name="priceGoc" id="priceGoc" required>
        </div>
        <div>
            <label for="discount">Giảm giá</label>
            <input type="number" name="discount" id="discount" required>
        </div>
        <div>
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="imageP">Hình ảnh</label>
            <input type="file" name="imageP" id="imageP" required>
        </div>

        <button type="submit" name="taomoi">Thêm sản phẩm</button>
    </form>
</body>

</html>