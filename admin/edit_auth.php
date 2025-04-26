<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include './layout/header.php'; ?>
    <h1>Chỉnh sửa quyền người dùng</h1>

    <form action="" method="POST">
        <label for="role">Quyền truy cập</label>
        <select name="role" id="role">
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select>
        <button type="submit" name="taomoi">Chỉnh quyền</button>
    </form>


</body>

</html>