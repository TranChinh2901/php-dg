<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 1) {
    header('location:././login.php');
}
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
    <h1>Welcome to Admin Panel</h1>
    <h2>Admin Email: <?php echo $_SESSION['email']; ?></h2>
    <h2>Admin Role: <?php echo $_SESSION['role']; ?></h2>
    <h2>Gender: <?php echo $_SESSION['gender']; ?></h2>
    
</body>

</html>