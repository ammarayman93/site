<?php
session_start();
require '../includes/order.php';

$order = new Order();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $cart = $_SESSION['cart'];
    $totalPrice = array_reduce($cart, function($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0);

    $orderId = $order->createOrder($userId, $totalPrice, $cart);

    if ($orderId) {
        unset($_SESSION['cart']);
        header("Location: order_success.php");
        exit();
    } else {
        $error = "حدث خطأ أثناء إتمام الشراء.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الشراء</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>إتمام الشراء</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <button type="submit" class="btn btn-success btn-block">تأكيد الشراء</button>
        </form>
    </div>
</body>
</html>