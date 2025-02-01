<?php
session_start();
require '../includes/auth.php';
require '../includes/product.php';

$auth = new Auth();
$product = new Product();

if (!$auth->isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = array_reduce($cart, function($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">سوق إلكتروني</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="products.php">المنتجات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>سلة التسوق</h1>
        <?php if (empty($cart)): ?>
            <div class="alert alert-info">سلة التسوق فارغة.</div>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>الإجمالي</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td><?php echo $item['name']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo $item['price']; ?> ريال</td>
                            <td><?php echo $item['price'] * $item['quantity']; ?> ريال</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="text-right">الإجمالي: <?php echo $totalPrice; ?> ريال</h4>
            <a href="checkout.php" class="btn btn-success btn-block">إتمام الشراء</a>
        <?php endif; ?>
    </div>
</body>
</html>