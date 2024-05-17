<?php
class Cart
{
    public static function addCart($memberId)
    {
        $sql = "INSERT INTO giohang VALUES (?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, $memberId]);
        if ($result == true) {
            return true;
        }
        return false;
    }

    public static function getCartByMemberId($memberId)
    {
        $cart = null;
        $sql = "SELECT * FROM giohang WHERE MaTV = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$memberId]);
        if ($result != false) {
            $cart = new GioHang($result);
        }
        return $cart;
    }
}
