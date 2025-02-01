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

$products = $product->getAllProducts();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المنتجات</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">سوق إلكتروني</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">سلة التسوق</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>المنتجات</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
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
    <script>
        function addToCart(id, name, price) {
            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: { id: id, name: name, price: price },
                success: function(response) {
                    alert('تمت إضافة المنتج إلى السلة.');
                },
                error: function() {
                    alert('حدث خطأ أثناء إضافة المنتج إلى السلة.');
                }
            });
        }
    </script>
</body>
</html>