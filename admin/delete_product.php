<?php
session_start();
include '../database/db.php';
if (!isset($_SESSION['email']) || $_SESSION['role'] != 1) {
    header('location:././login.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE idP = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Xóa sản phẩm thành công!";
        header('location:./product_list.php');
    } else {
        echo "Xóa sản phẩm thất bại!";
        header('location:./product_list.php');
    }
} else {
    echo "ID không hợp lệ.";
}
