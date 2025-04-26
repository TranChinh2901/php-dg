<?php
// session_start();
// if (isset($_SESSION['email'])) {
//     unset($_SESSION['email']);
//     header('location:login.php');
// }



session_start();

// Xóa tất cả các session
session_unset();     // Xóa tất cả các biến session
session_destroy();   // Hủy phiên session

// Chuyển hướng về trang login
header('Location: login.php');
exit();  // Đảm bảo không có code nào được thực thi sau khi chuyển hướng