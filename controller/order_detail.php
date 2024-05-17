<?php
class OrderDetail
{
    public static function insertOrderDetail($orderId, $productId, $count, $price, $colorId)
    {
        $sql = "INSERT INTO chitietdondathang VALUES (?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, $orderId, $productId, $count, $price, $colorId]);
        return $result;
    }
}
