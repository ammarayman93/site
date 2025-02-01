<?php
session_start();
require '../includes/auth.php';

$auth = new Auth();

if (!$auth->isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تمت العملية بنجاح</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success">
            <h4 class="alert-heading">تمت العملية بنجاح!</h4>
            <p>شكرًا لشرائك. تمت عملية الشراء بنجاح.</p>
        </div>
        <a href="products.php" class="btn btn-primary">العودة إلى المنتجات</a>
    </div>
</body>
</html>