<?php
class Order
{
    public static function insertAndGetPrimaryKeyOrder($memberId, $orderDate, $status, $totalPrice, $orderInfoId)
    {
        $sql = "INSERT INTO dondathang VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, $memberId, $orderDate, null, 0, null, $status, 0, $totalPrice, $orderInfoId]);
        if ($result == true) {
            return $db->getPDO()->lastInsertId();
        }
        return false;
    }
}
