<?php
session_start();
require 'includes/auth.php';
require 'includes/product.php';

$auth = new Auth();
$product = new Product();

if (!$auth->isLoggedIn()) {
    header("Location: pages/login.php");
    exit();
}

$products = $product->getAllProducts();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سوق إلكتروني</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">سوق إلكتروني</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="pages/cart.php">سلة التسوق</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/logout.php">تسجيل الخروج</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>المنتجات</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text">السعر: <?php echo $product['price']; ?> ريال</p>
                            <button class="btn btn-primary" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>)">إضافة إلى السلة</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>