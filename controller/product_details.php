<?php
class ProductDetail
{
    public static function getProductDetailByProductId($productId)
    {
        $productDetail = null;
        $sql = "SELECT * FROM chitietsanpham WHERE MaSP = ?";
        $db = new Database();
        $result = $db->fetch($sql, [$productId]);
        if ($result != false) {
            $productDetail = new ChiTietSanPham($result);
        }
        return $productDetail;
    }
}
