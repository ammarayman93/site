<?php
require 'db.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createOrder($userId, $totalPrice, $items) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->bind_param("id", $userId, $totalPrice);
        $stmt->execute();
        $orderId = $stmt->insert_id;

        foreach ($items as $item) {
            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $orderId, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        return $orderId;
    }

    public function getOrdersByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>