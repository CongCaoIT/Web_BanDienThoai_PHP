<?php
class CartDetail
{
    public static function addCartDetail($cartId, $productId, $count, $price, $colorId)
    {
        $sql = "INSERT INTO chitietgiohang VALUES (?, ?, ?, ?, ?, ?, ?)";
        $db = new Database();
        $result = $db->query($sql, [null, $cartId, $productId, $count, $price, $colorId, 0]);
        if ($result == true) {
            return true;
        }
        return false;
    }

    public static function getCartDetailByCartId($cartId)
    {
        $cartDetails = array();
        $sql = "SELECT * FROM chitietgiohang WHERE MaGioHang = ?";
        $db = new Database();
        $result = $db->fetchAll($sql, [$cartId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($cartDetails, new ChiTietGioHang($item));
            }
        }
        return $cartDetails;
    }

    public static function updateCountCartDetailByProductIdAndColorId($productId, $colorId, $cartId, $count)
    {
        $sql = "UPDATE chitietgiohang SET SoLuong = ? WHERE MaGioHang = ? AND MaSP = ? AND MaMau = ?";
        $db = new Database();
        $result = $db->query($sql, [$count, $cartId, $productId, $colorId]);
        if ($result == true) {
            return true;
        }
        return false;
    }

    public static function getCartDetailByProductIdAndColorId($productId, $colorId, $cartId)
    {
        $cartDetail = null;
        $sql = "SELECT * FROM chitietgiohang WHERE MaGioHang = ? AND MaSP = ? AND MaMau = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$cartId, $productId, $colorId]);
        if ($result != false) {
            $cartDetail = new ChiTietGioHang($result);
        }
        return $cartDetail;
    }

    public static function removeCartDetailByProductIdAndColorId($productId, $colorId, $cartId)
    {
        $sql = "DELETE FROM chitietgiohang WHERE MaGioHang = ? AND MaSP = ? AND MaMau = ?";
        $db = new Database();
        $result = $db->query($sql, [$cartId, $productId, $colorId]);
        return $result;
    }

    public static function updateCheckDatHang($productId, $colorId, $cartId, $check)
    {
        $sql = "UPDATE chitietgiohang SET DatHang = ? WHERE MaGioHang = ? AND MaSP = ? AND MaMau = ?";
        $db = new Database();
        $result = $db->query($sql, [$check, $cartId, $productId, $colorId]);
        return $result;
    }

    public static function setCheckToFalse()
    {
        $sql = "UPDATE chitietgiohang SET DatHang = ?";
        $db = new Database();
        $result = $db->query($sql, [0]);
        return $result;
    }

    public static function getCartDetailByCartIdAndChecked($cartId)
    {
        $cartDetails = array();
        $sql = "SELECT * FROM chitietgiohang WHERE MaGioHang = ? AND DatHang = 1";
        $db = new Database();
        $result = $db->fetchAll($sql, [$cartId]);
        if (count($result) > 0) {
            foreach ($result as $item) {
                array_push($cartDetails, new ChiTietGioHang($item));
            }
        }
        return $cartDetails;
    }
}
