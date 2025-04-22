<?php
session_start();
include '../database/db.php';


$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
</head>

<body>
    <div>
        <?php include "./layout/header.php" ?>
        <h1>Quản lý người dùng</h1>

        <table border="1" style="width: 100%; text-align: center;">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Hành động</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . ($row['role'] == 1 ? 'Admin' : 'User') . "</td>";
                    echo "<td><a href='delete_user.php?id=" . $row['id'] . "'>Xóa</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có người dùng nào.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>