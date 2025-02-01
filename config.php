<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'username');
define('DB_PASS', 'password');
define('DB_NAME', 'ecommerce');

// إعدادات PayPal (يمكن استبدالها بإعدادات Stripe)
define('PAYPAL_CLIENT_ID', 'your_paypal_client_id');
define('PAYPAL_SECRET', 'your_paypal_secret');
define('PAYPAL_RETURN_URL', 'http://yourdomain.com/checkout.php');
define('PAYPAL_CANCEL_URL', 'http://yourdomain.com/cart.php');
?>